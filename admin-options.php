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
	register_setting( $option_group, 'api_connector_auth_url' );
	register_setting( $option_group, 'api_connector_base_url' );
	register_setting( $option_group, 'api_connector_client_id' );
	register_setting( $option_group, 'api_connector_client_secret' );
}

