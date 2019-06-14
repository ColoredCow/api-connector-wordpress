<?php

$option_prefix = 'api_connector_';
$auth_url = esc_attr( get_option( "{$option_prefix}auth_url" ) );
$base_url = esc_attr( get_option( "{$option_prefix}base_url" ) );
$grant_type = esc_attr( get_option( "{$option_prefix}grant_type" ) ) ?: 'password';
$grant_client_credentials = array(
	'client_id' => esc_attr( get_option( "{$option_prefix}grant_client_credentials_client_id" ) ),
	'client_secret' => esc_attr( get_option( "{$option_prefix}grant_client_credentials_client_secret" ) ),
);
$grant_password = array(
	'client_id' => esc_attr( get_option( "{$option_prefix}grant_password_client_id" ) ),
	'client_secret' => esc_attr( get_option( "{$option_prefix}grant_password_client_secret" ) ),
	'username' => esc_attr( get_option( "{$option_prefix}grant_password_username" ) ),
	'password' => esc_attr( get_option( "{$option_prefix}grant_password_password" ) ),
);

?>
<div class="wrap">
	<h2><?php _e( 'API Connector Settings', 'api_connector' ); ?></h2>
	<div class="mb-7">
		<p><?php _e( 'These are the credentials required to connect with the API. Please contact your API provider and ask for these details.', 'api_connector' ); ?></p>
	</div>
	<form action="options.php" method="post">
		<?php settings_fields( 'api_connector' ); ?>
		<div class="mb-4">
			<label for="<?php echo "{$option_prefix}auth_url"; ?>"><?php _e( 'API Auth URL', 'api_connector'); ?></label>
			<input type="url" name="<?php echo "{$option_prefix}auth_url"; ?>" value="<?php echo $auth_url; ?>" class="d-block" />
			<small class="text-italic">Generally like https://myapi.com/auth/token</small>
		</div>
		<div class="mb-4">
			<label for="<?php echo "{$option_prefix}base_url" ?>"><?php _e( 'API Base URL', 'api_connector'); ?></label>
			<input type="url" name="<?php echo "{$option_prefix}base_url" ?>" value="<?php echo $base_url; ?>" class="d-block" />
			<small class="text-italic">Generally like https://myapi.com/api/v1</small>
		</div>
		<div class="mb-4">
			<label for="<?php echo "{$option_prefix}grant_type" ?>"><?php _e( 'Grant type', 'api_connector'); ?></label>
			<select name="<?php echo "{$option_prefix}grant_type" ?>">
				<option value="password" <?php echo 'password' == $grant_type ? 'selected' : ''; ?>><?php _e( 'Password', 'api_connector' ); ?></option>
				<option value="client_credentials" <?php echo 'client_credentials' == $grant_type ? 'selected' : ''; ?>><?php _e( 'Client Credentials', 'api_connector' ); ?></option>
			</select>
		</div>
		<div class="credentials-block <?php echo 'password' != $grant_type ? 'd-none' : ''; ?>" id="password">
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_password_client_id" ?>"><?php _e( 'Client ID', 'api_connector'); ?></label>
				<input type="text" name="<?php echo "{$option_prefix}grant_password_client_id" ?>" value="<?php echo $grant_password['client_id']; ?>" class="d-block" />
			</div>
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_password_client_secret" ?>"><?php _e( 'Client Secret', 'api_connector'); ?></label>
				<input type="text" name="<?php echo "{$option_prefix}grant_password_client_secret" ?>" value="<?php echo $grant_password['client_secret']; ?>" class="d-block" />
			</div>
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_password_username" ?>"><?php _e( 'Username', 'api_connector'); ?></label>
				<input type="text" name="<?php echo "{$option_prefix}grant_password_username" ?>" value="<?php echo $grant_password['username']; ?>" class="d-block" />
			</div>
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_password_password" ?>"><?php _e( 'Password', 'api_connector'); ?></label>
				<input type="password" name="<?php echo "{$option_prefix}grant_password_password" ?>" value="<?php echo $grant_password['password']; ?>" class="d-block" />
			</div>
		</div>
		<div class="credentials-block <?php echo 'client_credentials' != $grant_type ? 'd-none' : ''; ?>" id="client_credentials">
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_client_credentials_client_id" ?>"><?php _e( 'Client ID', 'api_connector'); ?></label>
				<input type="text" name="<?php echo "{$option_prefix}grant_client_credentials_client_id" ?>" value="<?php echo $grant_client_credentials['client_id']; ?>" class="d-block" />
			</div>
			<div class="mb-4">
				<label for="<?php echo "{$option_prefix}grant_client_credentials_client_secret" ?>"><?php _e( 'Client Secret', 'api_connector'); ?></label>
				<input type="text" name="<?php echo "{$option_prefix}grant_client_credentials_client_secret" ?>" value="<?php echo $grant_client_credentials['client_secret']; ?>" class="d-block" />
			</div>
		</div>
		<input type="hidden" name="<?php echo "{$option_prefix}refresh_token" ?>" value="0">
		<?php submit_button(__('Save changes', 'api_connector'));?>
	</form>
</div>
