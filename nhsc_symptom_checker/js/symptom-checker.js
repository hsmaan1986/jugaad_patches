(function ($, Drupal) {
    Drupal.behaviors.nhsc_symptom_checker = {
        hasRan: false,
        attach: function (context, settings) {

            jQuery('.start-button').on('click', function () {
                var scrollto = jQuery(this).attr('href');

                $('html, body').animate({
                    scrollTop: jQuery(scrollto).offset().top
                }, 1000);
            });

            // show label modal
            jQuery('.symptoms-checker .question-options label').on('click', function () {
                var tooltip = jQuery(this).attr('data-tooltip');
                jQuery('.question-modal .modal-body').html(tooltip);

                jQuery('#OptionModal').modal({'show': true});
            });

            // submit is clicked
            jQuery('.symptoms-submit-button').on('click', function () {

                // hide questions and intro
                jQuery('.symptoms-checker .question-area').hide();

                var responses = '';
                // get all checked radios
                jQuery('input[type="checkbox"][class="symptom-option"]:checked').each(function() {

                    responses += '<li>' +jQuery(this).val()+ '</li>';

                });

                // show results
                jQuery('.symptoms-checker .results').show();
                // show response list
                jQuery('.result-list').html(responses);

                // animate to results
                jQuery('html, body').animate({
                    scrollTop: $("#results").offset().top
                }, 1000);
            });
        }
    };



})(jQuery, Drupal);
