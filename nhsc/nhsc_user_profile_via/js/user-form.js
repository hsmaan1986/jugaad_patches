(function ($, Drupal) {
    Drupal.behaviors.nhsc_user_profile_via_user_form = {
        attach: function (context, settings) {
            var checkbox = $('#edit-field-medical-institute-value');
            if (checkbox.length) {
                var institution_visible = checkbox.is(':checked');

                if (institution_visible) {
                    toggle_institution_fields('show');
                } else {
                    toggle_institution_fields('hide');
                }

                checkbox.on('click', function () {
                    institution_visible = $('#edit-field-medical-institute-value').is(':checked');
                    if (institution_visible) {
                        toggle_institution_fields('show');
                    } else {
                        toggle_institution_fields('hide');
                    }
                });
            }

            // make gender field required
            jQuery('.form-composite.required input[type="radio"]', context).attr('required', 'required');
            jQuery('.form-select.required', context).attr('required', 'required');
        }
    };

    function toggle_institution_fields(state) {
        var fields = [
            'edit-field-institution-type-wrapper',
            'edit-field-institution-name-wrapper',
            'form-item-field-institution-id-number',
            'form-item-field-institution-id-number-0-value',
            'form-item-field-institution-address-zip',
            'form-item-field-institution-address-zip-0-value',
            'edit-field-institution-address-street-wrapper',
            'edit-field-institution-address-street-0-value',
            'edit-field-institution-address-number-wrapper',
            'edit-field-institution-address-number-0-value',
            'edit-field-institution-additional-wrapper',
            'edit-field-institution-additional-0-value',
            'edit-field-institution-address-city-wrapper',
            'edit-field-institution-address-city-0-value',
            'edit-field-institution-address-state-wrapper',
            'edit-field-institution-country-0-value',
            'edit-field-institution-country-wrapper',
            'edit-field-institution-id-number-wrapper',
            'edit-field-institution-address-zip-wrapper',
            'edit-field-institution-visited-wrapper',
        ];


        fields.forEach(function (currentValue, index) {
            $('#' + currentValue)[state]();
        });
    }

})(jQuery, Drupal);