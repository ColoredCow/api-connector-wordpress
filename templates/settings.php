<?php
	$auth_url = esc_attr( get_option( 'api_connector_auth_url' ) );
	$base_url = esc_attr( get_option( 'api_connector_base_url' ) );
	$client_id = esc_attr( get_option( 'api_connector_client_id' ) );
	$client_secret = esc_attr( get_option( 'api_connector_client_secret' ) );
?>
<div class="wrap">
	<h2><?php _e( 'API Connector Settings', 'api_connector' ) ?></h2>
	<div class="mb-7">
		<p><?php _e( 'These are the credentials required to connect with the API. Please contact your API provider and ask for these details.', 'api_connector' ) ?></p>
		<p><?php _e( '<strong>Note: </strong>The plugin currently only supports client credentials token authentication.', 'api_connector' ) ?></p>
	</div>
	<form action="options.php" method="post">
		<?php settings_fields( 'api_connector' ); ?>
		<div class="mb-4">
			<label for="api_connector_auth_url"><?php _e( 'API Auth URL', 'api_connector' ); ?></label>
			<input type="url" name="api_connector_auth_url" value="<?php echo $auth_url; ?>" />
			<small>Generally like https://myapi.com/auth/token</small>
		</div>
		<div class="mb-4">
			<label for="api_connector_base_url"><?php _e( 'API Base URL', 'api_connector' ); ?></label>
			<input type="url" name="api_connector_base_url" value="<?php echo $base_url; ?>" />
			<small>Generally like https://myapi.com/api/v1</small>
		</div>
		<div class="mb-4">
			<label for="api_connector_client_id"><?php _e( 'Client ID', 'api_connector' ); ?></label>
			<input type="text" name="api_connector_client_id" value="<?php echo $client_id; ?>" />
		</div>
		<div class="mb-4">
			<label for="api_connector_client_secret"><?php _e( 'Client Secret', 'api_connector' ); ?></label>
			<input type="text" name="api_connector_client_secret" value="<?php echo $client_secret; ?>" />
		</div>
		<?php submit_button( __( 'Save changes', 'api_connector' ) ); ?>
	</form>
</div>

<style>
	.mb-4 {
		margin-bottom: 15px;
	}
	.mb-7 {
		margin-bottom: 30px;
	}
	small {
		font-style: italic;
		margin-left: 2px;
		margin-top: 2px;
		color: #555;
	}
	input[type="url"],
	input[type="text"] {
		height: 30px;
		min-width: 600px;
		margin-left: 0;
		margin-right: 0;
		display: block;
	}
	label {
		display: inline-block;
		font-weight: bold;
		margin-bottom: 3px;
	}
</style>
