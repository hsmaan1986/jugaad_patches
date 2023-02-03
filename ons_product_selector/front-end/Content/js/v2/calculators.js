// Calculators
var sendData = "";
jQuery("#startCalculators").click(function (e) {

  e.preventDefault();
  if (
    jQuery("form#calculators_types input[type=checkbox]:not(:checked)")
      .length == jQuery("form#calculators_types input[type=checkbox]").length
  ) {
    jQuery(".ons__calculator__header .error").show();
    hideOverlay();
    return false;
  }

  jQuery(".ons__calculator__header .error").hide();
  sendData = jQuery(
    "form#calculators_types input[type=checkbox]:not(:checked)"
  )
    .map(function () {
      return {
        name: this.name,
        value: this.value,
      };
    })
    .get();
  var urlData = this.href;
  jQuery.ajax({
    url: urlData,
    data: sendData,
    beforeSend: function() {
      jQuery("#overlay").css('display', 'block');
    },
    cache: false,
    complete: function() {
        setTimeout(function () {
          jQuery(".modal-calculators").addClass("active");
          lockScroll();
          //hideOverlay();
          jQuery("#overlay").css('display', 'none');
        }, 400);
    },
    success: function (data) {
      //jQuery.get(this.href, sendData).done(function (data) {
      jQuery("#calculatorsTest").html(data);
      var wizard = "";
      var formData = "";
      var returnData = {};

      wizard = jQuery("#calculator-placeholder").steps({
        labels: {
          cancel: Drupal.t("Cancel"),
          current: Drupal.t("current step:"),
          pagination: Drupal.t("Pagination"),
          finish: Drupal.t("Finish"),
          next: Drupal.t("Next"),
          previous: Drupal.t("Previous"),
          loading: Drupal.t("Loading ...")
        },
        onInit: function (event, currentIndex) {
          jQuery(".calculator-breadcrumb li:eq(" + currentIndex + ")").addClass(
            "active"
          );
          refreshCalcProgressBar(
            currentIndex + 1,
            jQuery(".calculator-breadcrumb li").length
          );
          initOnsTooltip();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
          refreshCalcProgressBar(
            currentIndex + 1,
            jQuery(".calculator-breadcrumb li").length
          );
          jQuery(".calculator-breadcrumb li").removeClass("active");
          jQuery(".calculator-breadcrumb li:eq(" + currentIndex + ")").addClass(
            "active"
          );
          if (
            jQuery("#patient_data").find("select[name=patient_age]").val() >=
            70 &&
            priorIndex == 0
          ) {
            // wizard.steps("next");
          }
          // console.log(jQuery(".calculator-breadcrumb li").length);
          if (jQuery("#patient_data").find("select[name=patient_age]").val() < 70) {
            if (jQuery('li[data-id=check_dysphagia_risk_with_eat_10]').attr('class') != 'active') {
              if (jQuery(".calculator-breadcrumb li").length > 3) {
                wizard.steps("next");
              } else {
                wizard.steps("finish");
              }

            }

          }

          initOnsTooltip();
        },
        onStepChanging: function (e, currentIndex, newIndex) {
          if (currentIndex < newIndex) {
            return prepareForms(currentIndex, newIndex, returnData, wizard, jQuery("#calculator-placeholder form:visible"));
          }
          return true;
        },
        onFinishing: function (event, currentIndex) {
          return prepareForms(currentIndex, 0, returnData, wizard, jQuery("#calculator-placeholder form:visible"));
        },

        onFinished: function (event, currentIndex) {
          initOnsTooltip();
          jQuery(".calculator-breadcrumb li").removeClass("active");
          var finalIndex = currentIndex + 1;
          refreshCalcProgressBar(
            finalIndex + 1,
            jQuery(".calculator-breadcrumb li").length
          );
          jQuery(".calculator-breadcrumb li:eq(" + finalIndex + ")").addClass(
            "active"
          );
          jQuery
            .post(new URL(Drupal.url("ons_product_selector/calc/results"), globalUrl), returnData)
            .done(function (data) {
              jQuery("#calculator-placeholder").html(data);
              initOnsTabs();
            });
        },
      });

      jQuery(".calculator-breadcrumb li").each(function () {
        jQuery.ajaxSetup({
          async: false,
        });
        var title = jQuery(this).text();
        var loadForm =
          new URL(Drupal.url("ons_product_selector/calc/" + jQuery(this).attr("data-id")), globalUrl);
        jQuery.get(loadForm).done(function (data) {
          wizard.steps("add", {
            title: title,
            content: data,
          });
        });
      });
      wizard.steps("remove", jQuery(".calculator-breadcrumb li").length - 1);
      jQuery(".weight-form").hide();
      // jQuery("#patient_data select#patient-age").change(function () {
      //   if (jQuery(this).val() >= 70) {
      //     jQuery(".weight-form").show();
      //   } else {
      //     jQuery(".weight-form").hide();
      //   }
      // });

      // jQuery(".calculator--patientData").ready(function() {
      //   if(0 === jQuery(".calculator-breadcrumb").find('[data-id="malnutrition"]').length) {
      //     jQuery('#illnessCombo').remove();
      //   }
      // });

      jQuery("#patient_data input").blur(function (e) {
        function bmiRange(bmi) {
          if (bmi < 18.5) return "Underweight";
          if (bmi >= 18.5 && bmi < 25) return "Normal range";
          if (bmi >= 25 && bmi <= 30) return "Overweight";
          if (bmi > 30) return "Obese";
        }

        var height = Number(jQuery("#patient-height").val().replace(',', '.'));
        var weight = Number(jQuery("#patient-weight").val().replace(',', '.'));
        if (weight != "" && height != "") {
          var bmi = weight / Math.pow(height / 100, 2);
          var bmiRange = bmiRange(bmi);
          bmi = bmi.toFixed(1);
          console.log(Drupal);
          //drupalSettings.path.currentLanguage
          bmi = new Intl.NumberFormat(drupalSettings.path.currentLanguage).format(bmi);
          jQuery(".text--result").text(bmi);
        }
      });



      jQuery(document).on(
        "click",
        ".calculator--result__btnBack",
        function (e) {
          e.preventDefault();
          unlockScroll();
          jQuery(".modal-calculators").removeClass("active");
        }
      );

      jQuery(".modal-calculators--btn-close").click(function (e) {
        e.preventDefault();
        unlockScroll();
        jQuery(".modal-calculators").removeClass("active");
      });
    }
  });
});

// .always(function () {
//   setTimeout(function () {
//     jQuery(".modal-calculators").addClass("active");
//     lockScroll();
//     hideOverlay();
//   }, 300);
// })
  function prepareForms(currentIndex, newIndex, returnData, wizard, $form) {
    // if (jQuery('#nrs2002').is(':visible')) {
    //   var $form = jQuery("form#nrs2002");

    // } else if(jQuery('form#pre-nrs2002').is(':visible')) {
    //   var $form = jQuery('#pre-nrs2002');
    // } else {
    //   var $form = jQuery('#calculator-placeholder form:eq('+currentIndex+')');

    // }
    // console.log(currentIndex);
    // console.log(newIndex);
    var formId = $form.attr("id");
    var action = $form.attr("action");
    var values = $form.serialize();

    //console.log(formId);
    initOnsTooltip();
    switch (formId) {
      case undefined:
        return true;
        break;
      case "patient_data":
        jQuery.validator.setDefaults({
          debug: true,
        });

        var formValidate = jQuery("#patient_data").validate({
          rules: {
            patient_height: {
              required: true,
              min: 135,
              max: 215,
            },
            patient_weight: {
              required: true,
              min: 25,
              max: 110,
            },
            patient_weight_past: {
              min: 25,
              max: 110,
            },
          },
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!$form.valid()) return false;
        else break;
      case "patient_location":
        if (
          jQuery("#patient_data").find("select[name=patient_age]").val() < 70
        ) {
          var formValidate = jQuery("#patient_location").validate({
            errorPlacement: function (error, element) {
              jQuery(element)
                .parents(".calculator__form-group")
                .addClass("error");
              return true;
            },
          });
          if (!formValidate.form()) return false;
          else break;
        }
        break;
      case "eat_10":
        var formValidate = jQuery("#eat_10").validate({
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!formValidate.form()) return false;
        else break;
      case "must":
        var formValidate = jQuery("#must").validate({
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!formValidate.form()) return false;
        else break;
      case "pre-nrs2002":
        if (jQuery('#pre-nrs2002').is(':visible')) {

          var formValidate = jQuery('#pre-nrs2002').validate({
            errorPlacement: function (error, element) {
              jQuery(element)
                .parents(".calculator__form-group")
                .addClass("error");
              return true;
            }
          });
          if (!formValidate.form()) return false;

          reduced_dietary = jQuery('input[name=reduced_dietary]:checked').val();
          severity_ill = jQuery('input[name=severity_ill]:checked').val();

          if (reduced_dietary != 0 || severity_ill != 0) {
            jQuery('#nrs2002').show();
            jQuery('#pre-nrs2002').hide();
            return false;
          }
        }
        var formValidate = jQuery("#nrs2002").validate({
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!formValidate.form()) return false;
        else break;
      case "nrs2002":
        var formValidate = jQuery("#nrs2002").validate({
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!formValidate.form()) return false;
        else break;
      case "nutritional_needs":
        var formValidate = jQuery("#nutritional_needs").validate({
          errorPlacement: function (error, element) {
            jQuery(element)
              .parents(".calculator__form-group")
              .addClass("error");
            return true;
          },
        });
        if (!formValidate.form()) return false;
        else break;
    }

    var dataStore = (function () {
      jQuery.post(action, values).done(function (data) {
        // console.log(action);
        // console.log(values);
        formData = data;
      });
      return {
        getData: function () {
          if (formData) return formData;
        },
      };
    })();
    returnData[formId] = dataStore.getData();
    var patient_age = returnData.patient_data.patient_age;
    var formDataId = jQuery(
      ".calculator-breadcrumb li:eq(" + newIndex + ")"
    ).attr("data-id");

    if (
      (formDataId == "malnutrition" && typeof returnData.mna == "undefined") ||
      (formDataId == "patient_location" && patient_age >= 70)
    ) {
      // if(patient_age < 70) {
      //   return true;
      //   // return;
      // }
      jQuery
        .get(new URL(Drupal.url("ons_product_selector/calc/malnutrition"), globalUrl), returnData)
        .done(function (data) {
          var indexMalnutrition = newIndex;
          if (formDataId == "patient_location" && patient_age >= 70) {
            indexMalnutrition = newIndex + 1;
          }
          wizard.steps("remove", indexMalnutrition);
          wizard.steps("insert", indexMalnutrition, {
            content: data,
            title: jQuery(
              ".calculator-breadcrumb li:eq(" + indexMalnutrition + ")"
            ).text(),
          });
        });
    }
    if (
      jQuery(".calculator-breadcrumb li:eq(" + newIndex + ")").attr(
        "data-id"
      ) == "calculate_nutritional_needs"
    ) {
      var params = {
        age: returnData.patient_data.patient_age,
        weight: returnData.patient_data.patient_weight,
        height: returnData.patient_data.patient_height,
      };
      wizard.steps("remove", newIndex);
      wizard.steps("insert", newIndex, {
        title: jQuery(".calculator-breadcrumb li:eq(" + newIndex + ")").text(),
        contentMode: "async",
        contentUrl:
          new URL(Drupal.url("ons_product_selector/calc/calculate_nutritional_needs?" +
          jQuery.param(params)), globalUrl),
      });
    }
    jQuery(".modal-calculators").scrollTop(0);
    // console.log(returnData);
    return true;
  }

  function refreshCalcProgressBar(actual, total) {
    var progressBar = (actual / total) * 100;
    jQuery(".progress-bar span").width(progressBar + "%");
  }
