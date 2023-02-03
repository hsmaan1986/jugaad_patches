(function($, Drupal){
    Drupal.behaviors.nhsc_learn_to_grow_survey = {
        hasRan: false,
        attach: function (context, settings) {

            if (this.hasRan === false) {
                jQuery(".nhs-freestyle-widget-content .horizontal").appendTo(".tabs");
                jQuery(".tab-1").closest(".nwe-widget").attr('id', 'tab-1').appendTo(".tabs");
                jQuery(".tab-2").closest(".nwe-widget").attr('id', 'tab-2').appendTo(".tabs");
                jQuery(".tab-3").closest(".nwe-widget").attr('id', 'tab-3').appendTo(".tabs");
                jQuery(".tab-4").closest(".nwe-widget").attr('id', 'tab-4').appendTo(".tabs");
                jQuery(".tab-5").closest(".nwe-widget").attr('id', 'tab-5').appendTo(".tabs");


                jQuery('.tabs').tabslet();

                this.hasRan = true;
            }


        }// end attach

    };



})(jQuery, Drupal);