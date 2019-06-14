# API Connector WordPress

A simple plugin to consume custom REST APIs within your WordPress application.

### Installation steps

1. Clone or download this repository and add to your WordPress project `plugins/` directory.
2. Go to the admin dashboard and activate the plugin.


### Configurations

1. Once activated, you can configure the API settings from `Settings > API Connector`
2. Enter valid API configurations and credentials. Contact your API service team to get these details.

**Note**: The plugin only supports Client Credentials (token based) authentication right now.


### Usage

Once the configurations are complete and correct, copy the following test snippet in your active theme's `functions.php` file to check the API connection.

```php
add_action( 'init', 'api_test' );
function api_test() {
  $api_endpoint = 'test-api'; // this should be a valid endpoint at your API service
  $method = 'GET';
  $body = array();

  $api_connector = new Api_Connector();
  $response = $api_connector->make_api_call( $api_endpoint, $body, $method );
  
  echo $response;
}
```

If the response is same as you expected, then congratulations! You've successfully configured and used the plugin. If not, please double check the configurations.
