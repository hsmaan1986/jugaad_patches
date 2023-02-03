(function ($, Drupal) {
    Drupal.behaviors.nhsc_learn_to_grow_survey = {
        hasRan: false,
        attach: function (context, settings) {

            if (this.hasRan === false) {

                // show first tab on load
                var firstTab = jQuery('#nav-tab a[href="#nav-question-1"]');
                firstTab.tab('show');
                firstTab.addClass("active");

                jQuery('.questions').owlCarousel({
                    items: 3,
                    nav: true,
                });

                // select box onchange
                var selectedQuestions = [];


                jQuery("select[id^='question_']").on('change', function () {
                    var id = this.id;
                    var question_info = id.split("_");
                    var page_number = question_info[1];
                    var question_number = question_info[2];
                    var page = 'page_' + question_info[1];
                    var question = 'question_' + question_info[2];

                    var question_counter_selector = 'question-' +page_number+ '-count';
                    var conterSelector = jQuery('#' + question_counter_selector);

                    var q_count_last_v = parseInt(conterSelector.text());

                    if(jQuery.inArray(id, selectedQuestions) === -1) {
                        selectedQuestions.push(id);

                        // selectedQuestions[page] = [{
                        //     [question]: 'ets'
                        // }];

                        var q_count_curr_v = q_count_last_v + 1;
                    }

                    console.log('selectedQuestions: ', selectedQuestions);
                    conterSelector.text(q_count_curr_v);

                });

                // submit button
                jQuery(".results-button").on('click', function () {

                    // question answers
                    var question_form = {};
                    $.each(selectedQuestions, function (key, question) {
                        var question_arr = question.split("_");

                        var page = 'page_' + question_arr[1];
                        var number = 'question_' + question_arr[2];

                        // questions values


                        question_form[page] = {
                            'Amount': '',
                            'Weekly': '',
                            'ConvertedAmount': ''
                        };

                        console.log('question_arr', question_arr);
                    });


                    // submit clicked
                    var QuestionnaireAnswers = {
                        GeneralInfo: {
                            Name: jQuery("input[name='child_name']").val(),
                            Gender: jQuery("input[name='gender']:checked").val(),
                            AgeGroup: jQuery("input[name='child_age']:checked").val()
                        },
                        'Answers': question_form
                    };

                    console.log('QuestionnaireAnswers', QuestionnaireAnswers);

                });

                this.hasRan = true;


            }


        }// end attach

    };



})(jQuery, Drupal);