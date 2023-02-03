(function ($, Drupal, drupalSettings) {

    /*eslint no-console:0*/

    Drupal.behaviors.gigya_datepicker = {
        attach: function (context, settings) {
            window.__gigyaConf.customEventMap = {
                eventMap: [{
                    events: '*',
                    args: [function (e) {
                        return e;
                    }],
                    method: function (e) {
                        if (e.eventName == 'afterSubmit') {
                          //console.log('Gigya after submit');
                        }

                        if (e.eventName == 'afterScreenLoad') {
                            var module_configs = drupalSettings.gigya_datepicker_configs;

                            $( module_configs.field_selector ).datepicker({
                                showOn: "both",
                                "dateFormat": module_configs.date_format,
                                buttonText: "<i class='fa fa-calendar'></i>"
                            });

                        }

                        else if (e.fullEventName === 'logout') {

                        }
                    }
                }]
            };


        }
    };
})(jQuery, Drupal, drupalSettings);
