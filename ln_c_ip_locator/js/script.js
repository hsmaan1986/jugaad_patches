(function ($) {
  'use strict';

  Drupal.behaviors.ln_c_ip_locator = {
    attach: function (context, settings) {
      $(context).find('.ip_locator_popup').once("show_popup").each(function () {
        $.ajax({
          url: '/cdnping',
          cache: false,
          success: function (country_code) {
            if (!country_code && drupalSettings.ln_c_ip_locator.current_country.length != 0) {
              country_code = drupalSettings.ln_c_ip_locator.current_country;
            }

            let popup_config = Object.keys(drupalSettings.ln_c_ip_locator.data).filter(function (code) {
              return code == country_code;
            }, country_code);

            // Do not execute popup settings if configs not available.
            if (popup_config.length == 0) {
              return;
            }
            else {
              popup_config = drupalSettings.ln_c_ip_locator.data[popup_config];
            }

            var ip_locator_block = $('.ip_locator_popup');
            var logo = drupalSettings.ln_c_ip_locator.modal_logo.toString();
            // Set the body data.
            ip_locator_block.find('.popup-body').html('<p><img class="logo" src="'+ logo +'" alt="Logo" logdesc="Logo"></p>' + popup_config.body.value + '<p><div class="button-wrapper"><a class="ip_location_btn_yes" href="#">' + popup_config.btn_label_yes + '</a><a class="ip_location_btn_no" href="#">' + popup_config.btn_label_no + '</a></div></p>');
            var popup = Drupal.dialog(ip_locator_block, {
              title: '',
              buttons: []
            });
            var user_timestamp = function () {
              return Math.round((new Date()).getTime() / 1000);
            }
            var setIpLocationCookie = function (settings) {
              var cookie = {
                user_redirect_consent: settings.user_redirect_consent,
                redirect_url: settings.redirect_url,
                unix_expire: settings.cookie_validity
              }
              $.cookie('ln_c_ip_locator', JSON.stringify(cookie));
            }
            var getIpLocationCookie = function () {
              var cookie = $.cookie('ln_c_ip_locator');
              cookie = (cookie) ? JSON.parse(cookie) : null;
              var current_timestamp = user_timestamp();
              if (cookie && current_timestamp > cookie.unix_expire) {
                $.removeCookie('ln_c_ip_locator');
                cookie = null;
              }
              return cookie;
            }
            var cookie = getIpLocationCookie();
            var popup_settings = popup_config;
            if (cookie == null) {
              ip_locator_block.removeClass('hidden');
              popup.showModal();
            }
            else if ((cookie == null && typeof popup_settings.redirect_url != undefined && user_timestamp() < popup_settings.cookie_validity) || (cookie.unix_expire > popup_settings.cookie_validity)) {
              ip_locator_block.removeClass('hidden');
              popup.showModal();
            }
            else if (cookie.user_redirect_consent == true) {
              window.location.href = cookie.redirect_url;
            }
            else if (cookie.user_redirect_consent == false) {
              // User chose to stay in current site.
              // No actions required.
            }
            $('.ip_location_btn_yes').click(function (e) {
              e.preventDefault();
              dataLayer.push({
                'event': 'customEvent',
                'eventCategory': 'ip locator',
                'eventAction': 'ip locator yes click'
              });
              popup_settings.user_redirect_consent = true;
              setIpLocationCookie(popup_settings);
              popup.close();
              window.location.href = popup_settings.redirect_url;
            });
            $('.ip_location_btn_no').click(function (e) {
              e.preventDefault();
              dataLayer.push({
                'event': 'customEvent',
                'eventCategory': 'ip locator',
                'eventAction': 'ip locator no click'
              });
              popup_settings.user_redirect_consent = false;
              setIpLocationCookie(popup_settings);
              popup.close();
            });
          },

          /** Remove this line before deploying changes on production. */
          error: function(xhr, exception, thrownError) {
            var msg = '';

            if (xhr.status === 0) {
              msg = "Not connect.\n Verify Network.";
            } else if (xhr.status == 404) {
              msg = "Requested page not found. [404]";
            } else if (xhr.status == 500) {
              msg = "Internal Server Error [500].";
            } else if (exception === "parsererror") {
              msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
              msg = "Time out error.";
            } else if (exception === "abort") {
              msg = "Ajax request aborted.";
            } else {
              msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
            console.log(msg);
            if (callbackError) {
              callbackError(msg);
            }
          },
          crossDomain: true,
          async: false,
          isLocal: true,
        });
      });
    }
  };
}(jQuery));
