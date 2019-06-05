<?php

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Api_Connector {

	protected static $option_prefix = 'api_connector_';

	protected static function get_api_auth_url() {
		return get_option( self::$option_prefix . 'auth_url' );
	}

	protected static function get_api_base_url() {
		return get_option( self::$option_prefix . 'base_url' );
	}

	protected static function fetch_new_token() {
		$response = wp_remote_post( self::get_api_auth_url(), array(
			'sslverify' => false,
			'body' => array(
				'grant_type' => 'client_credentials',
				'client_id' => get_option( self::$option_prefix . 'client_id' ),
				'client_secret' => get_option( self::$option_prefix . 'client_secret' ),
			),
		));

		$token = json_decode( $response['body'] );

		update_option( self::$option_prefix . 'auth_token', $token->access_token );
		update_option( self::$option_prefix . 'auth_token_expiry', time() + intval($token->expires_in), false );
		return $token->access_token;
	}

	public static function get_token() {
		$auth_token = get_option( self::$option_prefix . 'auth_token' );
		if ( ! $auth_token ) {
			return self::fetch_new_token();
		}

		$is_token_expired = time() >= get_option( self::$option_prefix . 'auth_token_expiry' );
		if ( $is_token_expired ) {
			return self::fetch_new_token();
		}

		return $auth_token;
	}

	protected static function get_complete_endpoint( string $api_endpoint ) {
		return trailingslashit( self::get_api_base_url() ) . $api_endpoint;
	}

	public static function make_api_call( string $api_endpoint, array $body = array(), string $method = 'POST' ) {
		$response = wp_remote_post( self::get_complete_endpoint( $api_endpoint ), array(
			'method' => $method,
			'sslverify' => false,
			'body' => $body,
			'headers' => array(
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '. self::get_token(),
			),
		));
		return wp_remote_retrieve_body( $response );
	}
}
