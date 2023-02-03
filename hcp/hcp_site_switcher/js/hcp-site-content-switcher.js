(function ($, Drupal) {
    Drupal.behaviors.hcp_site_switcher = {
        hasRad: false,
        attach: function (context, settings) {

            if (this.hasRad === false) {

                var module_configs  = drupalSettings.hcp_site_switcher;
                var current_url     = module_configs.current_url;
                var prompt_once     = module_configs.prompt_once;
                var should_redirect = module_configs.redirect;
                var redirect_url    = module_configs.redirect_url;
                var current_is_hcp = module_configs.current_is_hcp;
                var hcp_type = module_configs.hcp_type;
                var hcp_status = module_configs.hcp_status;
                var switcher_id =  $("#hcp-site-switcher");
                var audienceBox = $('.AudienceToggleBox');


                //check if has more than one switcher on page
                if (audienceBox.length > 1) {
                    audienceBox.last().remove();
                }

                // -- Switcher CTA changed -- ///

                switcher_id.on("change", function () {
                    var promptPatientSwitchBack = jQuery('.AudienceToggle input[name=promptPatientSwitchBack]').val();
                    var _cookieHCP = parseInt(nhs_getCookie("isHCP"));


                    if (_cookieHCP == "1" && promptPatientSwitchBack == "False") {
                        nhs_writeCookiePlusOneYear("isHCP", "0", "/");

                        if (switcher_id.length) {
                            switcher_id.prop("checked", false);
                        }

                        NHSCheckAudienceRedirection(false);
                    } else {
                        OpenHcpPatientPopIn();
                    }
                    return false;
                });

                // --  Page has Switcher -- //
                if (audienceBox.length) {

                    var _cookieHCP = parseInt(nhs_getCookie("isHCP"));
                    var _isPROMPTED = parseInt(nhs_getCookie("isPROMPTED"));

                    // -- if hcp switcher has been checked - change the checkbox -- //
                    if (_cookieHCP === 1){
                        switcher_id.prop("checked", true);
                    }else{
                        switcher_id.prop("checked", false);
                    }

                    // Validate if prompt once feature is enabled //
                    if (prompt_once == 1){

                        // validate if user is already prompted
                        if (_isPROMPTED == 1){
                            NHSCheckAudienceRedirection(true);
                        }else{
                            NHSCheckAudienceRedirection(false);
                        }

                    }else{
                        NHSCheckAudienceRedirection(false);
                    }

                    $(document).on("click", ".AudienceToggleBox .hcp", function () {// hcp button clicked
                        nhs_writeCookiePlusOneYear("isHCP", "1", "/");

                        $('.header--container-activate').addClass('green-label');

                        if (switcher_id.length) {
                            switcher_id.prop("checked", true);
                        }
                        NHSCheckAudienceRedirection(true);
                        return false;
                    });

                    $(document).on("click", ".AudienceToggleBox .patient", function () {// patient button clicked
                        nhs_writeCookiePlusOneYear("isHCP", "0", "/");

                        $('.header--container-activate').removeClass('green-label');// remove green label class

                        if (switcher_id.length) {
                            switcher_id.prop("checked", false);
                        }
                        NHSCheckAudienceRedirection(true);
                        return false;
                    });

                    $(document).on("click", ".AudienceToggleBox a.auth_close", function () {
                        $('#hcp-modal').modal('hide');
                        return false;
                    });

                }

                 // allow entire hcp block to be clickable
                 $('.header-switcher-padding').on( "click", function() {
                    if(switcher_id.prop("checked", true)){
                        $('.header--container-activate').addClass('green-label');
                        $( "#hcp-site-switcher" ).trigger( "change" );
                    } else {
                        $('.header--container-activate').removeClass('green-label');
                        $( "#hcp-site-switcher" ).trigger( "change" );
                    }

                });

                if (hcp_status === 1) {
                  // Hide/Show HCP Toggle Based on User Input
                  checkHide(hcp_type);
                  // modify urls according to cookie
                  modifyURLs(_cookieHCP);
                }
                this.hasRad = true;

            }


        }
    };

    function checkHide (hcp_type){
      if (!/^(hcp|patient)$/.test(hcp_type)) {
        $('.header-switcher-padding').parent().parent().remove();
      }
    }

  /**
   *
   * @param hcpCookie
   *
   * assuming that all the urls are patient urls
   *
   * Update urls with 'hcp-active-link' class
   */
  function modifyURLs (hcpCookie) {

    if (hcpCookie == 1){// validate if hcp is selected

      // get all elements with flag
      jQuery(".hcp-active-link").each(function() {
        var href = jQuery(this).attr('href');
        var href_hcp = href + '-hcp';
        // modify url to hcp url
        jQuery(this).attr("href", href_hcp);

      });
    }

  }

    function checkRedirect (show_modal, should_redirect, redirect_url, current_is_hcp) {

        if (should_redirect === true) {
            if (show_modal === true){
                $('#hcp-switcher-redirect-modal').modal();
            }

            setInterval(function(){
                window.location = redirect_url;
            }, 5000);

        }

        if (current_is_hcp === true) {

            if (show_modal === true){
                $('#hcp-switcher-redirect-modal').modal();
            }
            setInterval(function(){
                window.location = redirect_url;
            }, 5000);

        }

    }

    function setCookie (key, value) {
        if (!!$.cookie(key)){
            $.cookie(key,  value);
        }else{
            $.cookie(key, value, { expires: 0.5, path: '/' });
        }
    }

    function nhs_getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i].trim();
            if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    function nhs_writeCookiePlusOneYear(name, value, path) {
        var expiration_date = new Date();
        expiration_date.setFullYear(expiration_date.getFullYear() + 1);
        expiration_date = expiration_date.toGMTString();
        var cookie_string = escape(name) + "=" + escape(value) + "; expires=" + expiration_date;
        if (path !== null)
            cookie_string += "; path=" + path;
        document.cookie = cookie_string;
    }


    function NHSCheckAudienceRedirection(promptedAlready) {
        var _cookieHCP = parseInt(nhs_getCookie("isHCP"));
        var module_configs  = drupalSettings.hcp_site_switcher;
        var hcp_type = module_configs.hcp_type;
        var __ok = true;

        var _page_audience_filter = $('.AudienceToggle input[name=audience]').val();
        if (/^(hcp|patient)$/.test(hcp_type)) {
            // -- If cookie is not set yet open popup on hcp & patient pages -- //
            if ( isNaN(_cookieHCP) || _cookieHCP != 1 &&
                 (_page_audience_filter == 'hcp' || _page_audience_filter == 'patient') &&
                 promptedAlready == false) {
                __ok = false;
                OpenHcpPatientPopIn();
            }
        }
        if (__ok) {
            var str = $('.AudienceToggle input[name=audience]').val();
            var _audiences = str.split(",");
            var _redirect = true;
            for (_val in _audiences) {
                if (_audiences[_val] == "" ||
                    (_audiences[_val] == "hcp" && _cookieHCP == 1) ||
                    (_audiences[_val] == "patient" && _cookieHCP == 0) ||
                    (_audiences[_val] == "patient" && isNaN(_cookieHCP) == true))
                {
                    _redirect = false;
                }
            }
            if (_redirect) {
                var _content = '<div class="AudienceToggleRedirectionBox">';
                if (_cookieHCP == 1) {
                    _content += $("#Patient_Redirection_message").html();
                } else {
                    _content += $("#HCP_Redirection_message").html();
                }
                _content += '</div>';
                setTimeout(function() {
                    $.fancybox.open([{
                        content: _content,
                        type: 'inline'
                    }], {
                        wrapCSS: 'nhs-fancybox',
                        padding: 0,
                        margin: 0,
                        scrolling: 'no',
                        closeBtn: false,
                        modal: true,
                        minHeight: 80
                    });
                }, 0);
                var _redirection = Drupal.checkPlain($('.AudienceToggle input[name=redirection]').val());
                var _suffix = Drupal.checkPlain($('.AudienceToggle input[name=suffix]').val());
                if (!_redirection) {
                    _redirection = document.location.href;
                    _redirection = _redirection.replace(_suffix, '');
                    _redirection = _redirection.split("?")[0].split("#")[0];
                    if (_audiences[_val] == "patient") {
                        var _pos = _redirection.indexOf(".aspx");
                        if (_pos === -1) {
                            _redirection += _suffix;
                        } else {
                            _redirection = _redirection.substring(0, _pos) + _suffix + _redirection.substring(_pos, _redirection.length);
                        }
                    }
                }
                setTimeout(function() {
                    document.location.href = _redirection;
                }, 2500);
            } else {
                $.fancybox.close();
            }
        }
    }

    function OpenHcpPatientPopIn() {

        nhs_writeCookiePlusOneYear("isPROMPTED", "1", "/");
        if (screen.width <= 480) {
            jQuery.fancybox.open([{href: '.AudienceToggleBox', type: 'inline'}], {
                wrapCSS: 'nhs-fancybox',
                padding: 0,
                margin: 0,
                scrolling: 'yes',
                closeBtn: false,
                minHeight: 100,
                modal: true
            });
        } else {
            jQuery.fancybox.open([{href: '.AudienceToggleBox', type: 'inline'}], {
                wrapCSS: 'nhs-fancybox',
                padding: 0,
                margin: 0,
                scrolling: 'no',
                closeBtn: false,
                minHeight: 100,
                modal: true
            });
        }
    }


})(jQuery, Drupal);
