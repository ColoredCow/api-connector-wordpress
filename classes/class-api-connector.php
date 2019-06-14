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

	protected static function get_token_request_body() {
		$grant_type = get_option( self::$option_prefix . 'grant_type' );
		$body = array(
			'grant_type' => $grant_type,
			'client_id' => get_option( self::$option_prefix . 'grant_' . $grant_type . '_client_id' ),
			'client_secret' => get_option( self::$option_prefix . 'grant_' . $grant_type . '_client_secret' ),
		);
		switch ($grant_type) {
			case 'password':
				$body['username'] = get_option( self::$option_prefix . 'grant_' . $grant_type . '_username' );
				$body['password'] = get_option( self::$option_prefix . 'grant_' . $grant_type . '_password' );
				break;
		}
		return $body;
	}

	protected static function fetch_new_token() {
		$response = wp_remote_post( self::get_api_auth_url(), array(
			'sslverify' => false,
			'body' => self::get_token_request_body(),
		));

		$token = json_decode( $response['body'] );
		update_option( self::$option_prefix . 'auth_token', $token->access_token );
		update_option( self::$option_prefix . 'auth_token_expiry', time() + intval($token->expires_in), false );
		update_option( self::$option_prefix . 'refresh_token', 0 );
		return $token->access_token;
	}

	public static function get_token() {
		$is_token_expired = time() >= get_option( self::$option_prefix . 'auth_token_expiry' );
		$refresh_token = get_option( self::$option_prefix . 'refresh_token' );
		if ( $is_token_expired || $refresh_token ) {
			return self::fetch_new_token();
		}

		$auth_token = get_option( self::$option_prefix . 'auth_token' );
		if ( ! $auth_token ) {
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
