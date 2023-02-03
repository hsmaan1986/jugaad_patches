/**
* Grunt Project
* Desenvolvido por F5 WEB DESIGN E TECNOLOGIA ATUALIZADA
* https://ef5.com.br/
* 2022-10-21 12:06:30 
**/
var patientData = {

  ageValidation: function () {
    jQuery("#patient_data select#patient-age").change(function () {
      if (jQuery(this).val() >= 65) {
        jQuery(".toogle-type--cc").show();
      } else {
        jQuery(".toogle-type--cc").hide();
      }
    });
  },

  bmiRange: function () {
    function bmiCalc(bmi) {
      if (bmi < 18.5) return "Underweight";
      if (bmi >= 18.5 && bmi < 25) return "Normal range";
      if (bmi >= 25 && bmi <= 30) return "Overweight";
      if (bmi > 30) return "Obese";
    }
    jQuery("#patient_data input").blur(function (e) {
      var height = jQuery("#patient-height").val();
      var weight = jQuery("#patient-weight").val();
      if (weight != "" && height != "") {
        var bmi = weight / Math.pow(height / 100, 2);
        var bmiRange = bmiCalc(bmi);
        jQuery(".text--result").text(bmi.toFixed(1));
      }
    });
  },


}


(function ($, Drupal, drupalSettings) {
  console.log(Drupal.behaviors);
});
