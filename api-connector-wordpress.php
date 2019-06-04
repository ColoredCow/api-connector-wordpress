<?php
/**
 * Plugin name: API Connector WordPress
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 * Version: 1.0.0
 * Contributors: rathorevaibhav
 * License: GNU GENERAL PUBLIC LICENSE
 * Description: A simple plugin that let's you connect with any REST API
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

define( 'API_CONNECTOR_ABSPATH', plugin_dir_path( __FILE__ ) );

/**
 * Load ApiConnector class, which holds common functions and variables.
 */
require_once API_CONNECTOR_ABSPATH . 'classes/class-api-connector.php';

/**
 * Load the admin controls
 */
require_once API_CONNECTOR_ABSPATH . 'admin-options.php';
