<?php
add_action( 'admin_menu', 'api_connector_admin_add_page' );
function api_connector_admin_add_page() {
	add_options_page( 'API Connector', 'API Connector', 'manage_options', 'api_connector', 'api_connector_settings_page' );
}

function api_connector_settings_page() {
	require_once API_CONNECTOR_ABSPATH . 'templates/settings.php';
}

add_action( 'admin_init', 'api_connector_register_settings' );
function api_connector_register_settings() {
	$option_group = 'api_connector';
	$option_prefix = 'api_connector_';
	register_setting( $option_group, $option_prefix . 'auth_url' );
	register_setting( $option_group, $option_prefix . 'base_url' );
	register_setting( $option_group, $option_prefix . 'grant_type' );
	register_setting( $option_group, $option_prefix . 'refresh_token' );

	// settings for client credentials grant type API requests
	register_setting( $option_group, $option_prefix . 'grant_client_credentials_client_id' );
	register_setting( $option_group, $option_prefix . 'grant_client_credentials_client_secret' );

	// settings for password grant type API requests
	register_setting( $option_group, $option_prefix . 'grant_password_client_id' );
	register_setting( $option_group, $option_prefix . 'grant_password_client_secret' );
	register_setting( $option_group, $option_prefix . 'grant_password_username' );
	register_setting( $option_group, $option_prefix . 'grant_password_password' );
}

