(function (jQuery) {
  Drupal.behaviors.nhsc_cerebral_palsy_tool = {
    attach: function (context, settings) {

      jQuery(".progress-step:only-child").addClass("last-step" );

      //Radio Btn MCWCP
      jQuery(".btn-continue a").attr("disabled", true);

      jQuery(".radio-btn").change(function() {

        jQuery(".radio-btn").closest('.radio').removeClass("btn-wrapper");

        if(jQuery(this).is(":checked")){

          jQuery(this).closest('.radio').addClass("btn-wrapper");

          jQuery(".btn-continue a").attr("disabled", false);

          var url = jQuery(this).data("link");
          var targeting = jQuery(this).data("targeting");

          jQuery(".btn-continue a").attr("href", url);

          var targetClass = '.radio-description-' + targeting;

          if (jQuery(targetClass).length) {
            jQuery('.cp_content_block__wrapper').hide();
            jQuery('.conditional-card-description').parent().hide();
            jQuery(targetClass).parent().show();
            jQuery(targetClass).show();

            if (jQuery('.cp_content_block__wrapper .cp_content-desc').text().length < 0) {
              jQuery('.conditional-card-descri-main .cp_content_block__wrapper').hide();
              jQuery('.conditional-card-descri-main').hide();
              jQuery(targetClass).parent().show();
              jQuery(targetClass).show();
            } else {
              jQuery(targetClass).parent().show();
              jQuery(targetClass).show();
            }

          }

        }

        else {

          jQuery(".btn-continue a").attr("disabled", true);

        }

      });

      jQuery('.cp_content_block__wrapper .cp_content-desc').each(function(index, item){

        if (!jQuery.trim(jQuery(this).text())){
          jQuery(this).parent().parent().addClass('hide-empty-block');
        }

      });

      //  if(jQuery(".sticky-wrapper")){
      //     jQuery( "#floating-icons, .feature-section, footer" ).hide();
      //  }

      if(jQuery(".step-1")) {
        jQuery('<style type="text/css">.block-cerebral-palsy-block{margin-top:0}</style>').appendTo("body");
      }
      else {
        jQuery('<style type="text/css">.block-cerebral-palsy-block{margin-top:-15px}</style>').appendTo("body");
      }

      // jQuery('a.cerebral-palsy-back-button').on('click', function (){
      //   // window.history.back();
      //   history.go(-1);
      // });

    }
  };

})(jQuery, Drupal, drupalSettings);
