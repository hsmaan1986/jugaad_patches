jQuery(document).ready(function($){

	jQuery(function () {
		jQuery('#edit-field-location-0-controls-location').keyup(function () {

			jQuery('#edit-field-address-0-value').val(jQuery(this).val());

		});
		jQuery('#edit-field-location-0-controls-location').change(function () {

			jQuery('#edit-field-address-0-value').val(jQuery(this).val());

		});
		jQuery('#edit-field-location-0-controls-location').on('blur', function() {

			jQuery('#edit-field-address-0-value').val(jQuery(this).val());

		});
	});			

});