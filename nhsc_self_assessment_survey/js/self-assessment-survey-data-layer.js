(function ($, Drupal) {
    Drupal.behaviors.nhsc_self_assessment_survey_data_layer = {
        hasRan: false,
        attach: function (context, settings) {

            $.fn.selfassessPush = function (event){
                dataLayer.push({
                    'event': 'customEvent',
                    'eventCategory': 'HA self assessment',
                    'eventAction': 'HA self assessment ' + event,
                    'eventLabel': window.location.href
                });
            };

            if( this.hasRan === false ) {

                // started
                jQuery('#self-assessment-next-button-1').on('click', function(){
                    $.fn.selfassessPush('started');
                });

                // finished
                jQuery('[id="self-assessment-button-submit"]').on('click', function(){
                    $.fn.selfassessPush('finished');
                });

                this.hasRan = true;
            }

        }
    };



})(jQuery, Drupal);