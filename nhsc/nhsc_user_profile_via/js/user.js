/**
 * Add tooltip to password
 */
// var passwordText = Drupal.t('Must be between 8-10 characters.');
//     passwordText += '<br>';
//     passwordText += Drupal.t('Must contain at least 1 uppercase and 1 lowercase character.');
//     passwordText += '<br>';
//     passwordText += Drupal.t('Must contain at least 1 number.');
//     passwordText += '<br>';
//     passwordText += Drupal.t('Must contain at least 1 symbol (!@#$%)');

(function ($, Drupal, drupalSettings) {

    /*eslint no-console:0*/

    "use strict";

    Drupal.nhsc_user_profile_via = {};
    Drupal.behaviors.nhsc_user_profile_via = {
        attach: function (context, settings) {
            var module_configs = drupalSettings.nhsc_user_profile_via_configs;

            /**
             * Password tool tip
             *
             */

            var passwordText = module_configs.password_tooltip;

            jQuery('.password-field').attr({
                    'data-html': 'true',
                    'data-toggle': 'tooltip',
                    'data-original-title': passwordText
                });

            /**
             *
             * Input Mask (ID Number)
             *
             */
            // lists of ID to mask
            var id_lists = ['edit-identification-number', 'edit-field-identification-number-0-value', 'edit-field-identification-number-1-value']

            var arrayLength = id_lists.length;
            for (var i = 0; i < arrayLength; i++) {
                var id_name = id_lists[i];
                var idmaskelement = document.getElementById(id_name);

                if (idmaskelement){
                    var idmaskOptions = {
                        mask: module_configs.id_number_mask
                    };

                    var mask = new IMask(idmaskelement, idmaskOptions);
                }

            }

            // Other occupation
            $('select#edit-occupation', context).on('change', function () {
                var occupation = this.value;

                console.log('occupation: ', occupation);
                var another_specialty = '';
                var selector = '#another-specialty-wrapper';

                if (occupation === 'hcp11'){
                    another_specialty = '<div class="form-item js-form-item form-type-textfield js-form-type-textfield form-item-another-specialty js-form-item-another-specialty form-group">';
                    another_specialty += '  <label for="edit-another-specialty--KQgz7H13IsE" class="control-label js-form-required form-required">Other Specialty</label>';
                    another_specialty += '  <input data-drupal-selector="edit-another-specialty" class="form-text required form-control" type="text" id="edit-another-specialty--KQgz7H13IsE" name="another_specialty" value="" size="60" maxlength="128" required="required" aria-required="true">';
                    another_specialty += '</div>';
                }

                $(selector).html(another_specialty);
            });


            /**
             *
             * Input Mask (Mobile Number)
             *
             */

            var cell_lists = ['field_mobile_number', 'edit-field-mobile-number-0-value']

            for (var k = 0; k < cell_lists.length; k++) {
                var cell_name = cell_lists[k];
                var cellmaskelement = document.getElementById(cell_name);

                if (cellmaskelement){
                    var cellmaskOptions = {
                        mask: '(00)00000-0000'
                    };

                    var mask = new IMask(cellmaskelement, cellmaskOptions);
                }

            }

        }
    };
})(jQuery, Drupal, drupalSettings);



