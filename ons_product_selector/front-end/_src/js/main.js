const url = new URL(window.location.href);
const globalUrl = new URL(window.location.href);
if (url.pathname.match(/(\/[a-z]{2}\/)/)) {
  lang = url.pathname.substr(0, 3);
} else {
  lang = '';
}

function parseHTML(html) {
  var t = document.createElement('template');
  t.innerHTML = html;
  return t.content;
}

function lockScroll() {
  jQuery("body").addClass("lock-scroll");
}

function unlockScroll() {
  jQuery("body").removeClass("lock-scroll");
}

function showOverlay() {
  jQuery("#overlay").show();
}

function hideOverlay() {
  jQuery("#overlay").hide();
}

function openSendEmail() {
  var $button = jQuery("#sendMail");
  var $form = jQuery("#sendMailContent");
  var active = $button.hasClass("active");

  if (active) {
    $button.removeClass("active");
    $form.removeClass("active").fadeOut();
  } else {
    $button.addClass("active");
    $form.addClass("active").fadeIn(300);
  }
}

function initOnsTooltip() {
  jQuery(".onsTooltip:not(.loaded)").each(function () {
    var $el = jQuery(this);
    var $tooltip = $el.find(".onsTooltip__content");
    var active = false;

    $el.addClass("loaded");

    window.addEventListener("click", function (e) {
      if (
        ($el[0].contains(e.target) && !active) ||
        $tooltip[0].contains(e.target)
      ) {
        $el.addClass("active");
        $tooltip.addClass("active");
        active = true;
      } else {
        $el.removeClass("active");
        $tooltip.removeClass("active");
        active = false;
      }
    });
  });
}

function initOnsTabs() {
  jQuery(".ons__tabs").each(function () {
    var $tab = jQuery(this);
    var $links = $tab.find(".ons__tabsLink");
    var $content = $tab.find(".ons__tabsContent");

    $content.hide();

    $links.click(function (e) {
      e.preventDefault();

      var $el = jQuery(this).parents(".ons__tabs");

      if ($el.hasClass("active")) {
        $el.find(".ons__tabsContent").slideUp().removeClass("active");
        $el.find(".ons__tabsLink").removeClass("active");
        $el.removeClass("active");
      } else {
        $el.find(".ons__tabsContent").slideDown().addClass("active");
        $el.find(".ons__tabsLink").addClass("active");
        $el.addClass("active");
      }
    });
  });
}
function openSendEmail() {
  var $button = jQuery("#sendMail");
  var $form = jQuery("#sendMailContent");
  var active = $button.hasClass("active");

  if (active) {
    $button.removeClass("active");
    $form.removeClass("active").fadeOut();
  } else {
    $button.addClass("active");
    $form.addClass("active").fadeIn(300);
  }
}

function initOnsTooltip() {
  jQuery(".onsTooltip:not(.loaded)").each(function () {
    var $el = jQuery(this);
    var $tooltip = $el.find(".onsTooltip__content");
    var active = false;

    $el.addClass("loaded");

    window.addEventListener("click", function (e) {
      if (
        ($el[0].contains(e.target) && !active) ||
        $tooltip[0].contains(e.target)
      ) {
        $el.addClass("active");
        $tooltip.addClass("active");
        active = true;
      } else {
        $el.removeClass("active");
        $tooltip.removeClass("active");
        active = false;
      }
    });
  });
}

function initOnsTabs() {
  jQuery(".ons__tabs").each(function () {
    var $tab = jQuery(this);
    var $links = $tab.find(".ons__tabsLink");
    var $content = $tab.find(".ons__tabsContent");

    $content.hide();

    $links.click(function (e) {
      e.preventDefault();

      var $el = jQuery(this).parents(".ons__tabs");

      if ($el.hasClass("active")) {
        $el.find(".ons__tabsContent").slideUp().removeClass("active");
        $el.find(".ons__tabsLink").removeClass("active");
        $el.removeClass("active");
      } else {
        $el.find(".ons__tabsContent").slideDown().addClass("active");
        $el.find(".ons__tabsLink").addClass("active");
        $el.addClass("active");
      }
    });
  });
}

// Reset boxes
jQuery(document).mouseup(function (e) {
  if (!searchBoxes.is(e.target) && searchBoxes.has(e.target).length === 0) {
    searchBoxes.removeClass("on");
  }
});

jQuery(".ons__modal").mouseup(function (e) {
  if (jQuery(".ons__modal").is(e.target)) {
    jQuery(".ons__modal").removeClass("on");
  }
});

jQuery(document).keyup(function (e) {
  if (e.keyCode === 27) {
    searchBoxes.removeClass("on");
    jQuery(".ons__modal").removeClass("on");
  }
});

jQuery(".ons__calculator__buttons").ready(function () {
  initOnsTooltip();
});

function ieVersion() {
  var ua = window.navigator.userAgent;

  if (ua.indexOf("Trident/7.0") > -1) return 11;
  else if (ua.indexOf("Trident/6.0") > -1) return 10;
  else if (ua.indexOf("Trident/5.0") > -1) return 9;
  else return 0; // not IE9, 10 or 11
}

function isIe() {
  return ieVersion() > 0;
}
jQuery(document).ready(function (jQuery) {
  var alertDiv = "";
  if (isIe()) {
    var alertDiv = document.createElement("div");
    var alertText = document.createElement("p");
    alertText.innerHTML = Drupal.t(
      "This site is not compatible with this browser and may affect your experience. Please use a more modern browser."
    );
    alertDiv.appendChild(alertText);
    alertDiv.classList.add("alert");
    alertDiv.classList.add("ieAlert");
    jQuery("header").prepend(alertDiv);
    return false;
  }
  // Init lazyload
  new LazyLoad({
    elements_selector: "[data-src], [data-bg]",
    class_loading: "lazy-loading",
    class_loaded: "lazy-loaded",
    class_error: "lazy-error",
  });
  initOnsTabs();
  jQuery("input:checkbox").prop("checked", false);

});

const searchBoxes = jQuery(
  ".ons__combobox__list > .ons__combobox__link, .ons__combobox__content > .ons__filters__combobox--options"
);

jQuery(".ons__combobox__list").ready(function () {
  // Search products

  jQuery("#overlay").hide();

  jQuery.get(Drupal.url('ajax/product_order'), function (orders) {
    orders = JSON.parse(orders);
    var arrSelected = [];

    jQuery("input[data-id=checkboxSearch]").change(function (e) {
      const $search = jQuery("#onsSearch");
      const url = new URL(Drupal.url("ons_product_selector/ajax/product_cards?" + $search.serialize()), globalUrl);

      let el = e.currentTarget;

      if (el.checked)
        arrSelected.push(el.value);
      else
        arrSelected.splice(arrSelected.indexOf(el.value), 1);


      if ($search.length > 0) {
        for (var i = 0; i < $search.length; i++) {
          if ($search.serializeArray().length > 0 && orders[$search.serializeArray()[i].value] != undefined)
            var selOrder = $search.serializeArray()[i].value;
          if (typeof selOrder != undefined && typeof orders[selOrder] != undefined)
            break
        }
      }

      jQuery("#overlay").show();
      searchBoxes.removeClass("on");

      jQuery.get(url, function (data) {

        let $html = jQuery(parseHTML(data));


        if (orders !== undefined && Object.keys(orders).length !== 0 && arrSelected.length > 0 && orders[arrSelected[0]] !== undefined) {
          Array.from(orders[arrSelected[0]]).reverse().forEach(function (value, index) {
            var $el = $html.find('[data-id="' + value + '"]');

            if ($el.length > 0) {
              jQuery($html[0].children).filter('section.ons__container').prepend($el[0].outerHTML);
              $el.remove();
            }


          })

        }

        jQuery("#block-onsproductselectorproductscards").html($html);

        jQuery("#checkbox__advanced").prop("checked", false);

        if (jQuery("input[data-id=checkboxSearch]:checked").length >= 1) {
          jQuery(".ons__btn--reset").removeClass("off");
        }
      })
        .done(function () {
          jQuery("#overlay").hide();

          new LazyLoad({
            elements_selector: "[data-src], [data-bg]",
            class_loading: "lazy-loading",
            class_loaded: "lazy-loaded",
            class_error: "lazy-error",
          });
        });
    });

  });

  // Search folders
  jQuery(".ons__combobox__link").click(function (e) {
    var idContent = jQuery(this).attr("data-content");
    if (jQuery(this).hasClass("on")) {
      jQuery("a[data-content=" + idContent + "], #" + idContent).removeClass(
        "on"
      );
    } else {
      searchBoxes.removeClass("on");
      jQuery("a[data-content=" + idContent + "], #" + idContent).addClass("on");
    }
    e.preventDefault();
  });

  // Compare checkboxes
  jQuery(document).on("click", ".ons__checkbox", function () {
    var productChecked = jQuery("input[data-id=compare-product]:checked")
      .length;
    var notChecked = jQuery("input[data-id=compare-product]:not(:checked)");

    if (productChecked >= 2) {
      jQuery(".ons__btn--compare").removeClass("disable");
    } else {
      jQuery(".ons__btn--compare").addClass("disable");
    }

    if (productChecked === 3) {
      notChecked.prop("disabled", true);
    } else {
      notChecked.prop("disabled", false);
    }
  });

  // Reset Button
  jQuery(document).on("click", ".ons__btn--reset", function (e) {
    jQuery("input[data-id=checkboxSearch]")
      .prop("checked", false)
      .triggerHandler("change");
    jQuery(this).addClass("off");
  });

  // Compare button
  jQuery(document).on("click", ".ons__btn--compare", function (e) {
    if (!jQuery(this).hasClass("disable")) {
      jQuery(".ons__modal").addClass("on");
      var products = [];
      jQuery.each(
        jQuery("input[data-id=compare-product]:checked"),
        function () {
          products.push("id[]=" + jQuery(this).val());
        }
      );

      jQuery.getJSON(
        new URL(Drupal.url("ons_product_selector/ajax/products_json"), globalUrl),
        function (data) {
          jQuery('.ons__combobox__link--options').empty();
          let dataRecived = data;
          jQuery(dataRecived).each(function (key, item) {
            jQuery(".ons__combobox__link--options").append(
              '<div class="ons__combobox__link--item" nid="' +
              item.id +
              '">' +
              item.name.replace('®', '<sup>®</sup>') +
              "</div>"
            );
          });
        }
      );

      jQuery.getJSON(
        new URL(Drupal.url("ons_product_selector/ajax/product_cards_json?" + products.join("&")), globalUrl),
        function (data) {
          let dataRecived = data;
          if (dataRecived.pip_hide == 1) {
            jQuery(".pip_code").hide();
          }
          for (var i = 0; i < 3; i++) {
            populateModal(data[i], i);
          }
        }
      );

      jQuery(document).on("click", ".ons__combobox__link--item", function () {
        jQuery(this).parent().removeClass("on");
        jQuery(".ons__combobox__link--modal").removeClass("on");

        var idCol = jQuery(this)
          .parent()
          .index(".ons__combobox__link--options");

        jQuery.getJSON(
          new URL(Drupal.url("ons_product_selector/ajax/product_cards_json?id[]=" +
            jQuery(this).attr("nid")), globalUrl),
          function (data) {
            populateModal(data[0], idCol);
          }
        );
      });

      jQuery(".ons__modal__select--item").each(function () { });
    }
  });


  function DownloadPdf() {
    showOverlay();
    jQuery(".calculator--result__buttons").hide();
    jQuery(".ons__tabsContent").show();
    jQuery(".calculator--result__btnBack").hide();
    jQuery("#sendMailForm").hide();
    createPDF().save().then(function() {
      jQuery(".calculator--result__buttons").show();
      jQuery(".calculator--result__btnBack").show();
      jQuery(".ons__tabsContent").hide();
      jQuery("#sendMailForm").show();
    });
    hideOverlay();
  }

  function createPDF() {
    var options = {
      margin: 5,
      enableLinks: false,
      filename: 'NHSCResults.pdf',
      image: {type: 'jpeg', quality: 1},
      jsPDF: {
        orientation: 'p',
        unit: 'pt',
        format: 'tabloid'
      },
      html2canvas: {scale: 1},
      pagebreak: {
        mode:  ['avoid-all', 'css', 'legacy']
      }
    };
    var element = jQuery("#result")[0];
    var worker = html2pdf().set(options).from(element);
    return worker;
  }

  function sendMailPdf() {
    // showOverlay();
    jQuery(".calculator--result__buttons").hide();
    jQuery(".ons__tabsContent").show();
    jQuery(".calculator--result__btnBack").hide();
    jQuery("#sendMailForm").hide();
    pdf = createPDF().outputPdf();
    pdf.then(function (pdf) {
      var formData = new FormData();
      formData.append("form", jQuery("#sendMailForm").serialize());
      formData.append("pdf", btoa(pdf));
      jQuery.ajax({
        url: new URL(Drupal.url("ons_product_selector/calculator/sendmail"), globalUrl),
        type: "POST",
        async: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
          jQuery("#mailStatus").show();
          jQuery("#mailStatus").html(
            '<span class="' + data.class + '">' + data.message + "</span>"
          );
          jQuery("#mailStatus")
            .delay(3000)
            .fadeOut("slow", function () {
              jQuery("#sendMailForm").fadeIn("slow");
            });
        },
      });
      jQuery(".calculator--result__buttons").show();
      jQuery(".calculator--result__btnBack").show();
      jQuery(".ons__tabsContent").hide();
      jQuery("#sendMailForm").show();
      // hideOverlay();
    });
  }

  jQuery(document).on("click", "#resultDownload", function (e) {
    e.preventDefault();
    DownloadPdf();
  });

  jQuery(document).on("click", ".ons__btn--close", function (e) {
    jQuery(".ons__modal").removeClass("on");
    e.preventDefault();
  });

  jQuery(document).on("click", ".product", function (e) {
    unlockScroll();
    jQuery(".modal-calculators").removeClass("active");
    e.preventDefault();
  });

  jQuery(document).on("click", "#sendMailButton", function (e) {
    e.preventDefault();
    var formValidate = jQuery("#sendMailForm").validate({
      rules: {
        email: {
          email: true,
          required: true,
        },
      },
      errorPlacement: function (error, element) {
        jQuery(element).removeClass("valid");
        jQuery(element).addClass("error");
        return true;
      },
    });

    if (!jQuery("#sendMailForm").valid()) {
      return false;
    }
    sendMailPdf();
  });

  // Product populate modal comparission
  function populateModal(item, key) {
    jQuery(".ons__modal__select--item:eq(" + key + ")>a").html(
      typeof item == "undefined" ? Drupal.t("Select our product") : item.title.replace('®', '<sup>®</sup>')
    );
    if (typeof item === "undefined" || item === null) {
      jQuery("img[data-key=" + key + "]").attr(
        "src",
        "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
      );
      jQuery("img[data-key=" + key + "]").attr("alt", null);
      jQuery("[data-field=field_ons_description]:eq(" + key + ")").text(null);
      jQuery("[data-field=field_ons_format_size]:eq(" + key + ")").text("-");
      jQuery("[data-field=field_ons_kcal]:eq(" + key + ")").text("-");
      jQuery("[data-field=field_ons_protein]:eq(" + key + ")").text("-");
      jQuery("[data-field=field_ons_flavours]:eq(" + key + ")").text(null);
      jQuery("[data-field=field_ons_pipcode]:eq(" + key + ")").text(null);
      jQuery("[data-field=title]:eq(" + key + ")").text(null);
      jQuery("[data-field=path]:eq(" + key + ")").text(null);
      jQuery("[data-field=path]:eq(" + key + ")").attr(
        "href",
        "javascript: void(0);"
      );
    }
    if (typeof item !== 'undefined') {
      jQuery('img[data-key=' + key + ']').attr('src', item.media_uri);
      jQuery('.ons__modal__link__product--image:eq(' + key + ')').attr('src', item.media_uri);
      jQuery('[data-field=field_ons_description]:eq(' + key + ')').html(item.field_ons_description.replace('®', '<sup>®</sup>'));
      jQuery('[data-field=field_ons_format_size]:eq(' + key + ')').html(item.field_ons_format_size);
      jQuery("[data-field=field_ons_kcal]:eq(" + key + ")").text(item.field_ons_kcal);
      jQuery("[data-field=field_ons_flavours]:eq(" + key + ")").text(item.field_ons_flavours.join(", "));
      jQuery("[data-field=field_ons_pipcode]:eq(" + key + ")").text(item.field_ons_pipcode);
      jQuery("[data-field=field_ons_protein]:eq(" + key + ")").text(item.field_ons_protein);
      jQuery("[data-field=title]:eq(" + key + ")").html(item.title.replace('®', '<sup>®</sup>'));
      jQuery("[data-field=path]:eq(" + key + ")").text(Drupal.t('> Find out more'));
      jQuery("[data-field=path]:eq(" + key + ")").attr(
        "href",
        item.node_url
      );
    }

    jQuery.each(item, function (field, value) {
      //jQuery('img[data-key=' + key + ']').attr('src', media_uri);
      // var tag = jQuery("[data-field=" + field + "]:eq(" + key + ")").get(0);
      // if (typeof tag !== "undefined") {
      //   var tagName = tag.tagName;
      // }
      // if (Array.isArray(value) && tagName !== "IMG") {
      //   value = value.map(function (v, k) {
      //     return v.name;
      //   });
      //   value = value.join(", ");
      // }
      // if (tagName === "IMG") {
      //   jQuery("[data-field=" + field + "]:eq(" + key + ")").attr(
      //     "src",
      //     value[0].field_images[0].url
      //   );
      //   jQuery("[data-field=" + field + "]:eq(" + key + ")").attr(
      //     "alt",
      //     value[0].field_images[0].alt
      //   );
      //   jQuery("[data-field=" + field + "]:eq(" + (key + 3) + ")").attr(
      //     "src",
      //     value[0].field_images[0].url
      //   );
      //   jQuery("[data-field=" + field + "]:eq(" + (key + 3) + ")").attr(
      //     "alt",
      //     value[0].field_images[0].alt
      //   );
      // } else if (tagName === "A") {
      //   jQuery("[data-field=" + field + "]:eq(" + key + ")").attr(
      //     "href",
      //     value
      //   );
      //   jQuery("[data-field=" + field + "]:eq(" + key + ")").text(
      //     "> Find out more"
      //   );
      // } else {
      //   jQuery("[data-field=" + field + "]:eq(" + key + ")").text(value);
      // }
    });
  }

});
function nl2br (str, replaceMode, isXhtml) {

  var breakTag = (isXhtml) ? '<br />' : '<br>';
  var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
}
