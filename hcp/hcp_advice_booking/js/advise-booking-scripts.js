(function ($, Drupal) {
    Drupal.behaviors.hcp_advice_booking = {
        attach: function(context, settings) {

            $( ".booking-day-accordion" ).accordion({ autoHeight: false });
            $( ".booking-year-accordion" ).accordion({ autoHeight: false });
        }
    }

}(jQuery, Drupal));


