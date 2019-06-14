jQuery(document).ready(function(){
	jQuery('[name="api_connector_grant_type"]').on('change', function(){
		jQuery('.credentials-block').addClass('d-none');
		jQuery('#' + jQuery(this).val()).removeClass('d-none');
		jQuery('[name="api_connector_refresh_token"]').val('1');
	});
});
