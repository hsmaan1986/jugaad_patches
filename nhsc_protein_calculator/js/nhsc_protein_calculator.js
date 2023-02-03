
(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.nhscProteinCalculatorBehavior = {
    attach: function (context, settings) {

      $('.measurement-data__wrapper input').click(function(){
        var radioValue = $(this).val();
        $('.measurement-data__wrapper input[type="radio"]').each(function(){
          $(this).prop('checked', false).removeClass('active');
          $(this).parent().removeClass('selected');
        });

        $('.measurement-data__wrapper input[value="' + radioValue + '"]').prop('checked', true).parent().addClass('selected');
      });

      if (!$('#edit-units .form-item.selected')[0]){
        $('#edit-units-metric-units').parent().parent().addClass("selected");
        $('.tabs-data__wrapper input[value="metric_units"]').prop('checked', true);
      }

      $('.tabs-data__wrapper input').click(function(){
          var radioValue = $(this).val();
          $('.tabs-data__wrapper input[type="radio"]').each(function(){
            $(this).prop('checked', false).removeClass('active');
            $(this).parent().parent().removeClass('selected');
          });

          $('.tabs-data__wrapper input[value="' + radioValue + '"]').prop('checked', true).parent().parent().addClass('selected');
      });

      //trigger radio change on label click

        $('#edit-gender .radio:first-child').click(function(){
          $(this).addClass('active');
          $('#edit-gender .radio:last-child').removeClass('active');
          $(this).children('label').prop('checked', true);
        });

        $('#edit-gender .radio:last-child').click(function(){
          $(this).addClass('active');
          $('#edit-gender .radio:first-child').removeClass('active');
          $(this).children("label").prop('checked', true);
        });

      // JS Validations
      $('#protein-calculator-form .js-form-submit').attr('disabled',true);
      $('form#protein-calculator-form').on('change', function (){

        var gender = $('[name="gender"]:checked').val();
        var units = $('[name="units"]:checked').val();
        var weight = $('[name="weight"]').val();
        var us_weight = $('[name="us_weight"]').val();
        var years = $('[name="years"]').val();
        var meter = $('[name="meter"]').val();
        var feet = $('[name="feet"]').val();
        var centimeter = $('[name="centimeter"]').val();
        var inches = $('[name="inches"]').val();
        var activity = $('.measurement-data__wrapper input:checked').val();

        var weight_max = $('[name="weight"]').attr("max");
        var weight_min = $('[name="weight"]').attr("min");
        var us_weight_max = $('[name="us_weight"]').attr("max");
        var us_weight_min = $('[name="us_weight"]').attr("min");
        var year_max = $('[name="years"]').attr("max");
        var year_min = $('[name="years"]').attr("min");
        var meter_max = $('[name="meter"]').attr("max");
        var meter_min = $('[name="meter"]').attr("min");
        var feet_max = $('[name="feet"]').attr("max");
        var feet_min = $('[name="feet"]').attr("min");
        var cm_max = $('[name="centimeter"]').attr("max");
        var cm_min = $('[name="centimeter"]').attr("min");
        var inches_max = $('[name="inches"]').attr("max");
        var inches_min = $('[name="inches"]').attr("min");

        var gender_pass = false;
        if (gender === 'undefined') {
          gender_pass = false;
        } else {
          gender_pass = false;
        }

        console.log('gender', gender);

        var yearDecimal = false;
        if (years.indexOf(".") >= 0) {
          yearDecimal = false;
        } else {
          yearDecimal = true;
        }

        var weightDecimal = false;
        if (weight.indexOf(".") >= 0) {
          weightDecimal = false;
        } else {
          weightDecimal = true;
        }

        var us_weightDecimal = false;
        if (us_weight.indexOf(".") >= 0) {
          us_weightDecimal = false;
        } else {
          us_weightDecimal = true;
        }

        var meterDecimal = false;
        if (meter.indexOf(".") >= 0) {
          meterDecimal = false;
        } else {
          meterDecimal = true;
        }

        var feetDecimal = false;
        if (feet.indexOf(".") >= 0) {
          feetDecimal = false;
        } else {
          feetDecimal = true;
        }

        var centimeterDecimal = false;
        if (centimeter.indexOf(".") >= 0) {
          centimeterDecimal = false;
        } else {
          centimeterDecimal = true;
        }

        var inchesDecimal = false;
        if (inches.indexOf(".") >= 0) {
          inchesDecimal = false;
        } else {
          inchesDecimal = true;
        }

        var weight_pass = false;
        if (parseInt($('[name="weight"]').val()) >= parseInt(weight_min) && parseInt($('[name="weight"]').val()) <= parseInt(weight_max)) {
          weight_pass = true;
        }

        var us_weight_pass = false;
        if (parseInt($('[name="us_weight"]').val()) >= parseInt(us_weight_min) && parseInt($('[name="us_weight"]').val()) <= parseInt(us_weight_max)) {
          us_weight_pass = true;
        }

        var years_pass = false;
        if (parseInt($('[name="years"]').val()) >= parseInt(year_min) && parseInt($('[name="years"]').val()) <= parseInt(year_max)) {
          years_pass = true;
        }

        var meters_pass = false;
        if (parseInt($('[name="meter"]').val()) >= parseInt(meter_min) && parseInt($('[name="meter"]').val()) <= parseInt(meter_max)) {
          meters_pass = true;
        }

        var feet_pass = false;
        if (parseInt($('[name="feet"]').val()) >= parseInt(feet_min) && parseInt($('[name="feet"]').val()) <= parseInt(feet_max)) {
          feet_pass = true;
        }

        var cm_pass = false;
        if (parseInt($('[name="centimeter"]').val()) >= parseInt(cm_min) && parseInt($('[name="centimeter"]').val()) <= parseInt(cm_max)) {
          cm_pass = true;
        }

        var inches_pass = false;
        if (parseInt($('[name="inches"]').val()) >= parseInt(inches_min) && parseInt($('[name="inches"]').val()) <= parseInt(inches_max)) {
          inches_pass = true;
        }

        if (units === 'us_units') {
          if (gender && us_weight && years && feet && inches && activity && us_weight_pass === true && years_pass === true
            && feet_pass === true && inches_pass === true && yearDecimal === true && us_weightDecimal === true && feetDecimal === true
            && inchesDecimal === true) {
            $('#protein-calculator-form .js-form-submit').attr('disabled',false);
          } else {
            $('#protein-calculator-form .js-form-submit').attr('disabled',true);
          }
        }

        if (units === 'metric_units') {
          if (gender && weight && years && meter && centimeter && activity && weight_pass === true && years_pass === true
            && meters_pass === true && cm_pass === true && yearDecimal === true && weightDecimal === true && meterDecimal === true
            && centimeterDecimal === true) {
            $('#protein-calculator-form .js-form-submit').attr('disabled',false);
          } else {
            $('#protein-calculator-form .js-form-submit').attr('disabled',true);
          }
        }

      });

      $('.block-views-blockpc-protein-calculator-food-column-block-1').css('display', 'none');
      $('.block-views-blockpc-product-banner-block-1').css('display', 'none');
      $('.block-views-blockpc-protein-calculator-slider-tab-block-1').css('display', 'none');
      $('.block-views-blockpc-protein-calculator-icons-bottom-block-1').css('display', 'none');
      if ( $('.calculator-results')[0] ) {
        $('.block-views-blockpc-protein-calculator-food-column-block-1').css('display', 'block');
        $('.block-views-blockpc-product-banner-block-1').css('display', 'block');
        $('.block-views-blockpc-protein-calculator-slider-tab-block-1').css('display', 'block');
        $('.block-views-blockpc-protein-calculator-icons-bottom-block-1').css('display', 'block');
        // $('#protein-calculator-form').css('display', 'none');
        $('#block-views-block-protein-facts-block-1').css('display', 'none');
        $('.personal-data').css('display', 'none');
        $('.measurement-data').css('display', 'none');
        $('.protein-calculator__wrapper button.js-form-submit').css('display', 'none');
        $('.page.full').css('display', 'none');
        $('h1.page-header').css('display', 'none');
        $('.protein-calculator-terms').css('display', 'none');
      }

      $( ".tabs-tab-list a" ).each(function( index ) {
        var appendToSection = $( this ).attr('href') + ' ' + '.js-accordeon-trigger';
        var appendToSectionExist = $( this ).attr('href') + ' ' + '.js-accordeon-trigger img';
        var currentTabId = '#' + $( this ).attr('id');
        var img = $(currentTabId).find("img").clone().addClass('js-accordeon-trigger-image-clone').addClass('js-accordeon-trigger-image-clone-' + index);
        var runImageOnce = 'js-accordeon-trigger-image-clone-' + index;
        if(!$('.js-accordeon-trigger-image-clone-0').length){
          $(img).appendTo(appendToSection);
        }

        if(!$('.js-accordeon-trigger-image-clone-1').length){
          $(img).appendTo(appendToSection);
        }

        if(!$('.js-accordeon-trigger-image-clone-2').length){
          $(img).appendTo(appendToSection);
        }

      });

      if($('.block-nhsc-protein-calculator').length){
        $('.messages__wrapper').addClass('nhsc-protein-calculator-messages').css('display', 'none');
      }

      $('.calculator-results').find('a[href="#"]').unbind('click');
      $('.calculator-results').find('a[href="#"]').on('click', function (e) {
        e.preventDefault();

        this.expand = !this.expand;
        console.log('this.expand', this.expand);

        $(this).text(this.expand?"Read less":"Read more");
        $(this).closest('.calculator-results').find('.small-page, .full-page').toggleClass('small-page full-page');

      });

      setTimeout(function(){
        $('.protein-calculator-tabs-slider .slick-next').trigger('click');
        }, 500);

    }
  };

})(jQuery, Drupal, drupalSettings );
