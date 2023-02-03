(function ($, Drupal) {
    Drupal.behaviors.nhsc_comiss_score_datalayer = {
        hasRan2: false,
        attach: function (context, settings) {

            $.fn.comissPush = function (event){
                dataLayer.push({
                    'event': 'customEvent',
                    'eventCategory': 'comiss',
                    'eventAction': 'comiss ' + event,
                    'eventLabel': window.location.href
                });
            };

            if (this.hasRan2 === false) {

                jQuery( document ).ready(function() {

                    // start, success, pdf download, error

                    // start
                    $.fn.comissPush('start');

                    // success
                    jQuery('#comiss-results-modal').on('shown.bs.modal', function (e) {

                        $.fn.comissPush('success');

                    });

                    // print
                    jQuery( window ).bind( "beforeprint", function() {
                        $.fn.comissPush('printed');
                    });

                    // pdf download
                    jQuery('.btn-download').on('click', function (e) {

                        $.fn.comissPush('pdf download');

                    });



                });


                this.hasRan2 = true;

            }



        }

    };


})(jQuery, Drupal);