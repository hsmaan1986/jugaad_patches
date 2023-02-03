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

    Drupal.nhsc_user_profile = {};
    Drupal.behaviors.nhsc_user_profile = {
        attach: function (context, settings) {
            var module_configs = drupalSettings.nhsc_user_profile_configs;

            var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);


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

                if (idmaskelement) {
                    if (isIE11 === false){// ie fix
                        var idmaskOptions = {
                            mask: module_configs.id_number_mask
                        };

                        var mask = new IMask(idmaskelement, idmaskOptions);
                    }
                }

            }


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
                    if (isIE11 === false) {// ie fix
                        var cellmaskOptions = {
                            mask: '(00)00000-0000'
                        };

                        var mask = new IMask(cellmaskelement, cellmaskOptions);
                    }
                }

            }

        }
    };
})(jQuery, Drupal, drupalSettings);



