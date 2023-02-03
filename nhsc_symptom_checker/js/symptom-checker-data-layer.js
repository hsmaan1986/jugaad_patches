(function ($, Drupal) {
    Drupal.behaviors.nhsc_symptom_checker_data_layer = {
        hasRan: false,
        attach: function (context, settings) {

            $.fn.symptomPush = function (event){
                dataLayer.push({
                    'event': 'customEvent',
                    'eventCategory': 'symptom checker',
                    'eventAction': 'symptom checker ' + event,
                    'eventLabel': window.location.href
                });
            };

            if (this.hasRan === false) {
                // start
                jQuery('.start-button').on('click', function () {
                    $.fn.symptomPush('started');
                });

                // finished
                jQuery('.symptoms-submit-button').on('click', function () {
                    $.fn.symptomPush('finished');
                });

                // print

                jQuery( window ).bind( "beforeprint", function() {
                    $.fn.symptomPush('printed');
                });

                this.hasRan = true;
            }

        }
    };



})(jQuery, Drupal);