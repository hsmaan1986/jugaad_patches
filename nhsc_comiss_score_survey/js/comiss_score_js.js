(function ($, Drupal) {
    Drupal.behaviors.nhsc_comiss_score_survey = {
        hasRan: false,
        attach: function (context, settings) {

            $.fn.comissScrollToError = function (selector){
                jQuery('html, body').animate({
                    scrollTop: jQuery('.question-validation:visible:first').offset().top
                }, 1000);
            };

            var module_configs = drupalSettings.nhsc_comiss_score_survey;
            var cutoff_value = module_configs.comiss_score_cutoff_value;
            var above_cutoff_copy = module_configs.above_cutoff_copy;
            var below_cutoff_copy = module_configs.below_cutoff_copy;

            var above_first_cta_link = module_configs.above_first_cta_link;
            var above_first_cta_text = module_configs.above_first_cta_text;
            var above_second_cta_link = module_configs.above_second_cta_link;
            var above_second_cta_text = module_configs.above_second_cta_text;

            var below_first_cta_link = module_configs.below_first_cta_link;
            var below_first_cta_text = module_configs.below_first_cta_text;
            var below_second_cta_link = module_configs.below_second_cta_link;
            var below_second_cta_text = module_configs.below_second_cta_text;



            jQuery("input[id^='edit-question-']").change(function(e) {
                var id = this.id;
                var qo = id.split("-");

                // get question number and value
                var q_number = qo[2];
                var q_value = qo[3];

                var score_selector = 'score_' + q_number;
                var print_score_selector = '.answer-score-' + q_number;
                var label_selector = 'edit-question-' + q_number + '-' + q_value;
                var print_label_text = '.answer-text-' + q_number;

                var label = jQuery("label[for='"+label_selector+"']").text().replace(/\s+/g, " ");

                // assign value to results text box
                jQuery("input[name='" + score_selector + "']").val(q_value);
                jQuery(print_score_selector).html(q_value);
                jQuery(print_label_text).html(label);

            });

            // help modal
            jQuery("span[id^='help-icon-']").click(function(e) {
                var idw = this.id;
                var ho = idw.split("-");

                jQuery('#comiss-help-modal-' + ho[2]).modal({'show': true});
            });

          // -- This adds active class to radio button when selected for styling -- //

          jQuery('.question-options input[type="radio"]').click(function(){
            var itemName = this.name;
            jQuery(':radio[name=' + itemName + ']').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
          });


            // result modal shown
            $('#comiss-results-modal').on('shown.bs.modal', function (e) {

                // adjust height
                $(this).css({
                    'max-height':'100%'
                });
                // sum all the scores
                var sum = 0;
                $("input[name^='score_']").each(function(){
                    var val = $(this).val();
                    if($.isNumeric(val)) {
                        sum += parseInt(val);
                    }
                });

                // show sum of results
                jQuery('.score-result').html(sum);
                // print final resuts
                jQuery('.final-results').html(sum);

                // print sum

                // check for cut off
                if(sum >= cutoff_value) {
                    // above cut off
                    jQuery('.score-copy-content').html(above_cutoff_copy);
                    jQuery('.score-cta-buttons-first').html('<a href="' +above_first_cta_link+ '" target="_blank">'+ above_first_cta_text +'</a>');
                    jQuery('.score-cta-buttons-second').html('<a href="' +above_second_cta_link+ '" target="_blank">'+ above_second_cta_text +'</a>');
                }else{
                    // below cut off
                    jQuery('.score-copy-content').html(below_cutoff_copy);
                    jQuery('.score-cta-buttons-first').html('<a href="' +below_first_cta_link+ '" target="_blank">'+ below_first_cta_text +'</a>');
                    jQuery('.score-cta-buttons-second').html('<a href="' +below_second_cta_link+ '" target="_blank">'+ below_second_cta_text +'</a>');
                }


            });

            if (this.hasRan === false) {
                $(document).on("click", "#print-comiss-resuts", function () {
                    window.print();
                    return false;
                });

                this.hasRan = true;
            }




        }
    };


})(jQuery, Drupal);
