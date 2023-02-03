(function ($, Drupal) {
    Drupal.behaviors.nhsc_self_assessment_survey = {
        hasRan: false,
        attach: function (context, settings) {

            var module_configs = drupalSettings.nhsc_self_assessment_survey;
            var result_a_score = module_configs.result_a_score;
            var result_b_score = module_configs.result_b_score;
            var result_c_score = module_configs.result_c_score;

            // show step 1
            show_step(1);

            function show_step (step) {
                jQuery('#self-assessment-step-'+step).show();
            }

            if( this.hasRan === false ) {

                // next button logic
                jQuery('[id^="self-assessment-next-button"]').on('click', function(){

                    var current_id = jQuery(this).closest('.survey-page').attr('id');

                    // hide current id
                    jQuery('#' + current_id).hide();

                    // show next id
                    var id_num = current_id.split('-');
                    var next_id = 'self-assessment-step-' + parseInt(parseInt(id_num[3]) + 1);
                    // show next step
                    jQuery('#' + next_id).show();
                });

                // previous button logic
                jQuery('[id^="self-assessment-previous-button"]').on('click', function(){

                    var current_id = jQuery(this).closest('.survey-page').attr('id');

                    // hide current id
                    jQuery('#' + current_id).hide();

                    // show next id
                    var id_num = current_id.split('-');
                    var next_id = 'self-assessment-step-' + parseInt(parseInt(id_num[3]) - 1);
                    // show previous step
                    jQuery('#' + next_id).show();
                });

                // submit button
                jQuery('[id="self-assessment-button-submit"]').on('click', function(){

                    var sum = 0;
                    // get all checked radios
                    jQuery('input[type="radio"][class="assessment-question"]:checked').each(function() {
                        var q_name = jQuery(this).attr('name');

                        jQuery('.nhsc-self-assessment-survey-results .score .'+q_name).html(jQuery(this).val());

                        sum += parseInt(jQuery(this).val());

                    });

                    // hide previous results
                    jQuery('.nhsc-self-assessment-survey-results .result-list').hide();

                    // results
                    if (sum <= result_a_score){
                        // show result a
                        jQuery('.nhsc-self-assessment-survey-results .results_a').show();
                    }else if (sum > result_a_score && sum <= result_c_score) {
                        // show results b
                        jQuery('.nhsc-self-assessment-survey-results .results_b').show();
                    }else if (sum > result_c_score) {
                        jQuery('.nhsc-self-assessment-survey-results .results_c').show();
                    }

                    // hide the form
                    jQuery('.nhsc-self-assessment-survey-form').hide();

                    // sum
                    jQuery('.sum-results').html(sum);

                });

                this.hasRan = true;
            }

        }
    };



})(jQuery, Drupal);