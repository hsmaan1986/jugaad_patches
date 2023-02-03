var NHSMainMenu = [];
var NHSSubMenu = [];
jQuery(document).ready(function () {
    AutoSizeNHSMenu();
    if (jQuery(".SubNavigation.NavIsFixed").length) {
        if (nhs_getCookie("nhsSubNavPos") === "") {
            var smpos = parseInt(jQuery(".SubNavigation").offset().top);
            nhs_writeCookiePlusOneYear("nhsSubNavPos", smpos, "/");
        }
        jQuery(window).scroll(function () {
            var smpos = parseInt(nhs_getCookie("nhsSubNavPos"));
            var stop = parseInt(jQuery(this).scrollTop());
            if (stop >= smpos) {
                jQuery(".SubNavigation").addClass("f_nav");
            } else {
                jQuery(".SubNavigation").removeClass("f_nav");
            }
        });
    }
    if (jQuery(".HomeContentPush").length) {
        var h = jQuery(".HomeContentPush .text-wrapper").outerHeight();
        var t = jQuery(".HomeContentPush .text-wrapper").position().top;
        var ih = jQuery(".HomeContentPush .image-wrapper").height();
        if (ih < (h + t)) {
            jQuery(".HomeContentPush .image-wrapper").height(ih + ((h + t) - ih) + 20);
        }
    }
    var h = window.location.hash;
    if (h) {
        if (h.indexOf("nhsacc") > 0) {
            var a = h.split("-");
            var i = parseInt(a[1]);
            var elm = jQuery(".accordeon:eq(" + i + ")");
            if (!elm.hasClass("expanded")) {
                elm.addClass("expanded");
                elm.children(".accordeon-content").show();
            }
            scrollToElm(elm);
        }
    }
    if (jQuery(".place-for-hcp-switch").length) {
        jQuery(document).on("click", ".place-for-hcp-switch .switch", function () {
            var promptPatientSwitchBack = sanitize (jQuery('.AudienceToggle input[name=promptPatientSwitchBack]').val());
            var _cookieHCP = parseInt(nhs_getCookie("isHCP"));
            if (_cookieHCP == "1" && promptPatientSwitchBack == "False") {
                nhs_writeCookiePlusOneYear("isHCP", "0", "/");
                if (jQuery(".place-for-hcp-switch").length) {
                    jQuery(".place-for-hcp-switch").removeClass("switch_on");
                    jQuery(".place-for-hcp-switch").addClass("switch_off");
                }
                NHSCheckAudienceRedirection();
            } else {
                OpenHcpPatientPopIn();
            }
            return false;
        });
    }
    if (jQuery(".AudienceToggle").length) {
        NHSCheckAudienceRedirection();
        jQuery(document).on("click", ".AudienceToggleBox a.hcp", function () {
            nhs_writeCookiePlusOneYear("isHCP", "1", "/");
            if (jQuery(".place-for-hcp-switch").length) {
                jQuery(".place-for-hcp-switch").removeClass("switch_off");
                jQuery(".place-for-hcp-switch").addClass("switch_on");
            }
            NHSCheckAudienceRedirection();
            return false;
        });
        jQuery(document).on("click", ".AudienceToggleBox a.patient", function () {
            nhs_writeCookiePlusOneYear("isHCP", "0", "/");
            if (jQuery(".place-for-hcp-switch").length) {
                jQuery(".place-for-hcp-switch").removeClass("switch_on");
                jQuery(".place-for-hcp-switch").addClass("switch_off");
            }
            NHSCheckAudienceRedirection();
            return false;
        });
        jQuery(document).on("click", ".AudienceToggleBox a.auth_close", function () {
            jQuery.fancybox.close();
            return false;
        });
    }
    ;jQuery(document).on("DOMNodeInserted", ".nwe-setting-item-fields", function () {
        jQuery(".nwe-setting-item-label span:contains('ShowHeader')").text('HideTopMargin');
        jQuery(".nwe-setting-item-label span:contains('ShowFooter')").text('HideBottomMargin');
    })
    jQuery(document).on("click", "#header .open-settings", function () {
        if (jQuery(this).hasClass("open")) {
            jQuery(this).removeClass("open");
            jQuery("#header .mobile-background-settings").hide();
        } else {
            jQuery(this).addClass("open");
            jQuery("#header .mobile-background-settings").show();
        }
    });
    jQuery(".nhs-site-search input").keyup(function (e) {
        if (e.keyCode == 13) {
            jQuery(".nhs-site-search a").click();
        }
    });
    jQuery(".nhs-site-search a").click(function () {
        var input = encodeURIComponent(sanitize (jQuery(".nhs-site-search input").val()));
        window.location.href = sanitize (jQuery("#nhs-search-url").html()) + "?q=" + input;
        return false;
    });
    jQuery(".nhs-site-search input").click(function () {
        if (this.value == this.defaultValue) {
            jQuery(".nhs-site-search input").val('');
        }
    });
    jQuery(".media-search input").keyup(function (e) {
        if (e.keyCode == 13) {
            jQuery(".media-search a").click();
        }
    });
    jQuery(".media-search a").click(function () {
        var input = encodeURIComponent(sanitize (jQuery(".media-search input").val()));
        window.location.href = sanitize (window.location.pathname) + '?k=' + input;
        return false;
    });
    jQuery(".media-search input").click(function () {
        if (this.value == this.defaultValue) {
            jQuery(".media-search input").val('');
        }
    });
    jQuery('.SearchMedia .YearFilter a').click(function () {
        var url = sanitize (window.location.pathname) + '?setYear=' + sanitize (jQuery(this).text());
        window.location.href = url;
        return false;
    });
    jQuery(".MedicalConditionPushBlock").on("mouseenter mouseleave click", MedicalConditionPushBlockEffect);
    jQuery(".BrandPushBlock").on("mouseenter mouseleave click", BrandPushBlockEffect);
    jQuery("#nhs2-menu .menu").on("mouseenter mouseleave click", NHSMenuEffect);
    jQuery(".SubNavigation .level-0").on("mouseenter mouseleave click", NHSSubMenuEffect);
    jQuery("#nhs2-menu .level-1.hasChild .level1Action").click(function () {
        var __ul = jQuery(this).next("ul");
        if (__ul.is(":visible")) {
            __ul.hide();
            jQuery(this).removeClass("visible");
        } else {
            __ul.show();
            jQuery(this).addClass("visible");
        }
        return false;
    });
    jQuery(".burger-menu #nhs2-menu .level-1.hasChild .level1Action").each(function (index) {
        var __ul = jQuery(this).next("ul");
        jQuery(this).removeClass("visible");
        __ul.hide();
    });
    jQuery("#nhs2-menu .main-nav .menu").each(function (index) {
        NHSMainMenu[index] = [];
        jQuery(this).find('a').each(function (index2) {
            var _a = sanitize (jQuery(this).attr("href"));
            if (_a != "/#nhsGetChild" && _a != "/") {
                var _p = _a.split("/");
                if (_p.length > 1) {
                    var _v = _p[1];
                    if (_v.toLowerCase() != "pages" && _v != "") {
                        if (NHSMainMenu[index].indexOf(_v) == -1) {
                            NHSMainMenu[index].push(_v.toLowerCase());
                        }
                    }
                }
            }
        });
    });
    jQuery(".SubNavigation .mobile").click(function () {
        if (jQuery(".SubNavigation .links").is(":visible")) {
            jQuery(this).removeClass("visible");
            jQuery(".SubNavigation .links").hide();
        } else {
            jQuery(this).addClass("visible");
            jQuery(".SubNavigation .links").show();
        }
        return false;
    });
    jQuery(".SubNavigation .level-0.hasChild a.link0").click(function () {
        var isMobile = jQuery(".SubNavigation ").hasClass("bar-menu");
        if (isMobile) {
            if (jQuery(this).parent().hasClass("opened")) {
                jQuery(this).parent().removeClass("opened");
            } else {
                jQuery(this).parent().addClass("opened");
            }
        }
        return false;
    });
    jQuery(".SubNavigation .sublinks").each(function (index) {
        var __parent = jQuery(this).parent();
        var _val = (jQuery(this).outerWidth() - __parent.outerWidth()) / 2;
        jQuery(this).css("left", -_val);
    });
    jQuery(".SubNavigation .links .level-0").each(function (index) {
        NHSSubMenu[index] = [];
        jQuery(this).find('a').each(function (index2) {
            var _a =  jQuery(this).attr("href");
            _a = _a.replace("Pages/", "");
            _a = _a.replace(".aspx", "");
            if (_a != "/") {
                if (NHSSubMenu[index].indexOf(_a) == -1) {
                    NHSSubMenu[index].push(_a.toLowerCase());
                }
            }
        });
    });
    jQuery("#header .nav-button").click(function () {
        if (jQuery(this).parent().is("#nhs-menu")) {
            jQuery("#nhs-menu").stop().slideToggle();
        } else {
            jQuery("#nhs-menu").stop().slideToggle();
        }
        if (jQuery(this).parent().is("#nhs2-menu")) {
            jQuery("#nhs2-menu .main-nav").stop().slideToggle();
        } else {
            jQuery("#nhs2-menu .main-nav").stop().slideToggle();
        }
        jQuery(this).toggleClass("nav-open");
        return false;
    });
    jQuery(".accordeon .accordeon-header").click(function () {
        jQuery(this).parent().find(".accordeon-content").stop(false, true).slideToggle("fast");
        jQuery(this).parent().toggleClass("expanded");
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'useraction',
            'eventCategory': 'general content',
            'eventAction': 'accordeon toggle',
            'eventLabel': window.location.href,
            'eventValue': undefined,
            'eventNonInteraction': 0
        });
        return false;
    });
    jQuery(".medical-condition-group").click(function () {
        var __ul = jQuery(this).next("ul");
        if (__ul.is(":visible")) {
            __ul.hide();
            jQuery(this).removeClass("visible");
        } else {
            __ul.show();
            jQuery(this).addClass("visible");
        }
        return false;
    });
    jQuery(document).on("click", "a.youtube", function () {
        var href =  jQuery(this).attr("href");
        var vidcode = GetIsYoutubeId(href);
        if (vidcode != "" && !jQuery(this).hasClass("clicked")) {
            jQuery(this).addClass("clicked");
            jQuery(this).parent().prepend('<iframe width="1" height="1" src="https://www.youtube.com/embed/' + vidcode + '?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>');
            jQuery(this).fadeOut(400);
        }
        return false;
    });
    if (jQuery(".AvailableStoryPatientStory").length) {
        jQuery(".AvailableStoryPatientStory li a").each(function (index) {
            var href = jQuery(this).attr("href");
            if (href == '#') {
                jQuery(this).parent().html(jQuery(this).html());
            } else {
                var vidcode = GetIsYoutubeId(href);
                if (vidcode != "") {
                    jQuery(this).addClass("youtube");
                    jQuery(this).append('<span class="video"></span>');
                    jQuery(this).wrap('<div class="youtube-wrapper"></div>');
                }
            }
        });
    }
    jQuery(".fancy-products").fancybox({
        wrapCSS: 'nhs-root big-products-images-slider',
        prevEffect: 'none',
        nextEffect: 'none',
        beforeShow: function () {
            this.title = jQuery(this.element).next('.fancy-product-content').html();
        },
        helpers: {title: {type: 'inside'}}
    });
    if (jQuery("#owl-productImagescarousel").length) {
        jQuery("#owl-productImagescarousel").owlCarousel({
            singleItem: true,
            autoPlay: true,
            navigation: true,
            pagination: true,
            stopOnHover: true,
            slideSpeed: 500
        });
    }
    if (jQuery(".KeyFactBlock").length) {
        jQuery(".KeyFactBlock .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                singleItem: true,
                autoPlay: _settings.autoPlay,
                navigation: false,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".ProductRelatedproducts").length) {
        var _nbItems = jQuery(".ProductRelatedproducts").find(".product").length;
        if (_nbItems > 1) {
            _nbItems = 2;
        }
        jQuery(".ProductRelatedproducts .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                items: _nbItems,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: false,
                autoPlay: _settings.autoPlay,
                navigation: true,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".BrandProductZone").length) {
        var _nbItems = jQuery(".BrandProductZone").find(".product").length;
        if (_nbItems > 2) {
            _nbItems = 3;
        }
        jQuery(".BrandProductZone .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                items: _nbItems,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: false,
                autoPlay: _settings.autoPlay,
                navigation: true,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".HealthyTips").length) {
        jQuery(".HealthyTips .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                singleItem: true,
                autoPlay: _settings.autoPlay,
                navigation: true,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".Recipes").length) {
        jQuery(".Recipes .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                singleItem: true,
                autoPlay: _settings.autoPlay,
                navigation: true,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".homeCarousel").length) {
        jQuery(".homeCarousel .owl-carousel").each(function (index) {
            var _settings = CarouselGetSettingsValues(this);
            jQuery(this).owlCarousel({
                singleItem: true,
                autoPlay: _settings.autoPlay,
                navigation: true,
                pagination: true,
                stopOnHover: true,
                slideSpeed: _settings.slideSpeed
            });
        });
    }
    if (jQuery(".brandsCarousel").length) {
        jQuery("#owl-brandscarousel").owlCarousel({
            singleItem: true,
            autoPlay: true,
            navigation: false,
            pagination: true,
            stopOnHover: true,
            slideSpeed: 500
        });
    }
    if (jQuery(".SymptomsTrackerTools").length) {
        jQuery("#openTrackerTool").click(function () {
            if (IsTouchDevice()) {
                return true;
            } else {
              var _url = jQuery(this).attr("href");

              jQuery.ajax({
                  crossOrigin: false,
                  url: _url,
                  success: function(data) {
                    var _content = '<div class="AssessmentToolBox cf">' + jQuery(data).find(".AssessmentToolBox").html() + '</div>';
                    jQuery.fancybox.open([{content: _content, type: 'inline'}], {
                      wrapCSS: 'nhs-fancybox',
                      padding: 0,
                      margin: 0,
                      scrolling: 'no',
                      closeBtn: true,
                      minHeight: 100
                    });
                  }
                });

                return false;
            }
        });
    }
    jQuery(document).on("click", ".AssessmentToolBox .next", function () {
        var current_screen = jQuery(this).parent();
        var pn = parseInt((current_screen.attr('id')).split("_")[1]);
        var next_screen = jQuery("#screen_" + (pn + 1));
        if (next_screen.hasClass("result")) {
            var nbChecked = jQuery(".AssessmentToolBox :checkbox:checked").length;
            next_screen.find(".description").hide();
            if (nbChecked == 0) {
                jQuery(".recap-symptoms-list").hide();
                next_screen.find(".description:eq(0)").show();
            } else if (nbChecked == 1) {
                jQuery(".recap-symptoms-list").show();
                jQuery(".symptoms-list").html('<li>' + jQuery(".AssessmentToolBox :checkbox:checked")[0].nextSibling.nodeValue + '</li>');
                next_screen.find(".description:eq(1)").show();
            } else {
                jQuery(".recap-symptoms-list").show();
                jQuery(".AssessmentToolBox :checkbox:checked").each(function (index) {
                    jQuery(".symptoms-list").append('<li>' + this.nextSibling.nodeValue + '</li>');
                });
                next_screen.find(".description:eq(2)").show();
            }
            next_screen.find(".description:eq(3)").show();
        }
        next_screen.show();
        current_screen.hide();
        jQuery.fancybox.reposition();
        return false;
    });
    jQuery(document).on("click", ".AssessmentToolBox .previous", function () {
        var current_screen = jQuery(this).parent();
        var pn = parseInt((current_screen.attr('id')).split("_")[1]);
        var previous_screen = jQuery("#screen_" + (pn - 1));
        previous_screen.show();
        current_screen.hide();
        return false;
    });
    jQuery(document).on("click", ".AssessmentToolBox .print", function () {
        var content = '<html><body><img src="/skin-engine-shared/NHSSkin/css/images/logo.png"><br><br>';
        content += "<br><br>" + jQuery(".AssessmentToolBox .introduction").html();
        content += "<br><br>" + jQuery(".recap-symptoms-list").html();
        jQuery("#screen_5 .description:visible").each(function (index) {
            content += "<br><br>" + jQuery(this).html();
        });
        content += "</body>";
        content += "</html>";
        var printWin = window.open('', '', 'left=0,top=0,width=1000,height=500,toolbar=0,scrollbars=0,status =0');
        printWin.document.write(content);
        printWin.document.close();
        printWin.focus();
        printWin.print();
        printWin.close();
        return false;
    });
    jQuery(".nhs_expandable").each(function (index) {
        var _ctHeight = jQuery(this).height('auto').height();
        var classList = jQuery(this).attr('class').split(/\s+/);
        var _nbLines = 6;
        var _lh = parseInt(jQuery(this).css('line-height'), 10);
        if (isNaN(_lh)) {
            _lh = 28;
        }
        jQuery.each(classList, function (index, item) {
            if (item.match("^nblines_")) {
                _nbLines = item.split("_")[1];
            }
        });
        var _h = (_nbLines * _lh);
        if (jQuery(this).hasClass("kfContentBlock")) {
            _h = 300;
        }
        if (jQuery(this).hasClass("productContentBlock")) {
            _h = 300;
        }
        if (_ctHeight > _h) {
            jQuery(this).height(_h);
            jQuery(this).append('<div class="readmore"  data-min-height="' + _h + '"><a href="#" class="button">' + jQuery("#ReadMoreJS_ReadMore").val() + '</a></div>');
        } else {
            jQuery(this).css('height', 'auto');
        }
    });
    jQuery(document).on("click", ".StoreLocator #storeLocatorShowMap", function () {
        jQuery(".StoreLocator .results").removeClass("list");
        jQuery(".StoreLocator .results").addClass("map");
        return false;
    });
    jQuery(document).on("click", ".StoreLocator #storeLocatorShowList", function () {
        jQuery(".StoreLocator .results").removeClass("map");
        jQuery(".StoreLocator .results").addClass("list");
        return false;
    });
    NHS_HighlightMainNavMenu();
    if (jQuery(".SubNavigation").length) {
        NHS_HighlightSubNavMenu();
    }
    setTimeout(function () {
        NHSAlignElmHeight();
    }, 200);
});
jQuery(window).load(function () {
    jQuery(".MedicalConditionPushBlock").each(function () {
        var s_push = jQuery(this).height();
        var s_title = jQuery(this).find(".title").height();
        var t = s_push - s_title - 30;
        jQuery(this).find(".text-wrapper").css({top: t + 'px'});
        jQuery(this).find(".text-wrapper").css('visibility', 'visible');
    });
    jQuery(".BrandPushBlock").each(function () {
        var s_push = jQuery(this).height();
        var t = s_push;
        jQuery(this).find(".text-wrapper").css({top: t + 'px'});
        jQuery(this).find(".text-wrapper").css('visibility', 'visible');
    });
});
(function (jQuery) {
    GetIsYoutubeId = function (href) {
        var vidcode = "";
        var arr = href.split('v=');
        if (arr.length > 1) {
            var vidcode = arr[1].substr(0, 11);
        } else if (href.indexOf('youtu.be') > -1) {
            arr = href.split('youtu.be');
            var vidcode = arr[1].substr(1, 11);
        }
        return vidcode;
    };
    IsTouchDevice = function () {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return true;
        }
        return false;
    };
    MedicalConditionPushBlockEffect = function (event) {
        var _elm = event.currentTarget;
        var maxTop = 290;
        var minTop = 40;
        var s_push = jQuery(_elm).height();
        var s_title = jQuery(_elm).find(".title").height();
        var t = s_push - s_title - 30;
        if (!IsTouchDevice() && event.type == "mouseenter") {
            jQuery(_elm).find(".color-panel").stop().animate({height: jQuery(".MedicalConditionPushBlock").height() + 'px'});
            jQuery(_elm).find(".text-wrapper").stop().animate({top: minTop + 'px'});
            jQuery(_elm).toggleClass("mcpb_1");
        } else if (!IsTouchDevice() && event.type == "mouseleave") {
            jQuery(_elm).find(".color-panel").stop().animate({height: '10px'});
            jQuery(_elm).find(".text-wrapper").stop().animate({top: t + 'px'});
            jQuery(_elm).toggleClass("mcpb_1");
        } else if (IsTouchDevice() && event.type == "click") {
            if (jQuery(_elm).hasClass("mcpb_1")) {
                jQuery(_elm).find(".color-panel").stop().animate({height: '10px'});
                jQuery(_elm).find(".text-wrapper").stop().animate({top: t + 'px'});
                jQuery(_elm).toggleClass("mcpb_1");
            } else {
                jQuery(_elm).find(".color-panel").stop().animate({height: jQuery(".MedicalConditionPushBlock").height() + 'px'});
                jQuery(_elm).find(".text-wrapper").stop().animate({top: minTop + 'px'});
                jQuery(_elm).toggleClass("mcpb_1");
            }
        }
    };
    BrandPushBlockEffect = function (event) {
        var _elm = event.currentTarget;
        var s_push = jQuery(_elm).height();
        var t = s_push;
        if (!IsTouchDevice() && event.type == "mouseenter") {
            jQuery(_elm).find(".color-panel").stop().animate({height: jQuery(".BrandPushBlock").height() + 'px'});
            jQuery(_elm).find(".text-wrapper").stop().animate({top: '40px'});
            jQuery(_elm).toggleClass("bpb_1");
        } else if (!IsTouchDevice() && event.type == "mouseleave") {
            jQuery(_elm).find(".color-panel").stop().animate({height: '0px'});
            jQuery(_elm).find(".text-wrapper").stop().animate({top: t + 'px'});
            jQuery(_elm).toggleClass("bpb_1");
        } else if (IsTouchDevice() && event.type == "click") {
            if (jQuery(_elm).hasClass("bpb_1")) {
                jQuery(_elm).find(".color-panel").stop().animate({height: '0px'});
                jQuery(_elm).find(".text-wrapper").stop().animate({top: t + 'px'});
                jQuery(_elm).toggleClass("bpb_1");
            } else {
                jQuery(_elm).find(".color-panel").stop().animate({height: jQuery(".BrandPushBlock").height() + 'px'});
                jQuery(_elm).find(".text-wrapper").stop().animate({top: '40px'});
                jQuery(_elm).toggleClass("bpb_1");
            }
        }
    };
    NHSMenuEffect = function (event) {
        var _elm = event.currentTarget;
        var isBurger = jQuery("#header").hasClass("burger-menu");
        if (!isBurger && event.type == "mouseenter") {
            jQuery(_elm).addClass("opened");
        } else if (!isBurger && event.type == "mouseleave") {
            jQuery(_elm).removeClass("opened");
        } else if (isBurger && event.type == "click") {
            if (jQuery(_elm).hasClass("opened")) {
                jQuery(_elm).removeClass("opened");
            } else {
                jQuery(_elm).addClass("opened");
            }
        }
    };
    NHSSubMenuEffect = function (event) {
        var _elm = event.currentTarget;
        var isMobile = jQuery(".SubNavigation ").hasClass("bar-menu");
        if (!isMobile && event.type == "mouseenter") {
            jQuery(_elm).addClass("opened");
        } else if (!isMobile && event.type == "mouseleave") {
            jQuery(_elm).removeClass("opened");
        }
    };
})(jQuery)

function OpenHcpPatientPopIn() {
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

function NHSCheckAudienceRedirection() {
    var _cookieHCP = parseInt(nhs_getCookie("isHCP"));
    var __ok = true;
    if (jQuery(".place-for-hcp-switch").length) {
        if (_cookieHCP != 1) {
            _cookieHCP = 0;
            nhs_writeCookiePlusOneYear("isHCP", "0", "/");
        }
    } else {
        if (_cookieHCP !== 0 && _cookieHCP != 1) {
            __ok = false;
            jQuery(window).load(function () {
                OpenHcpPatientPopIn();
            });
        }
    }
    if (__ok) {
        var str = jQuery('.AudienceToggle input[name=audience]').val();
        var _audiences = str.split(",");
        var _redirect = true;
        for (_val in _audiences) {
            if (_audiences[_val] == "" || (_audiences[_val] == "hcp" && _cookieHCP == 1) || (_audiences[_val] == "patient" && _cookieHCP == 0)) {
                _redirect = false;
            }
        }
        if (_redirect) {
            var _content = '<div class="AudienceToggleRedirectionBox">';
            if (_cookieHCP == 1) {
                _content += jQuery("#Patient_Redirection_message").html();
            } else {
                _content += jQuery("#HCP_Redirection_message").html();
            }
            _content += '</div>';
            setTimeout(function () {
                jQuery.fancybox.open([{content: _content, type: 'inline'}], {
                    wrapCSS: 'nhs-fancybox',
                    padding: 0,
                    margin: 0,
                    scrolling: 'no',
                    closeBtn: false,
                    modal: true,
                    minHeight: 80
                });
            }, 0);
            var _redirection = sanitize (jQuery('.AudienceToggle input[name=redirection]').val());
            var _suffix = sanitize (jQuery('.AudienceToggle input[name=suffix]').val());
            if (!_redirection) {
                _redirection = sanitize (location.href);
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
            setTimeout(function () {
                location.href = _redirection;
            }, 2500);
        } else {
            jQuery.fancybox.close();
        }
    }
}

function CarouselGetSettingsValues(_this) {
    var _valAutoPlaySpeed = parseInt(jQuery(_this).prev().children(".CarouselAutoPlaySpeed").val());
    if (_valAutoPlaySpeed % 1 !== 0) {
        _valAutoPlaySpeed = 0;
    }
    if (_valAutoPlaySpeed <= 0) {
        _valAutoPlaySpeed = false;
    }
    var _valSlideSpeed = parseInt(jQuery(_this).prev().children(".CarouselSlideSpeed").val());
    if (_valSlideSpeed % 1 !== 0) {
        _valSlideSpeed = 0;
    }
    if (_valSlideSpeed <= 0) {
        _valSlideSpeed = 300;
    }
    return {autoPlay: _valAutoPlaySpeed, slideSpeed: _valSlideSpeed}
}

function nhs_getCookie(cname) {
    return jQuery.cookie(cname);
}

function nhs_writeCookiePlusOneYear(name, value, path) {
    var expiration_date = new Date();
    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
    expiration_date = expiration_date.toGMTString();

    jQuery.cookie(name, escape(value), {
      expires : expiration_date, // Expires date
      path    : path,          // The value of the path attribute of the cookie
      secure  : true          // If set to true the secure attribute of the cookie
    });
}

function scrollToElm(elm) {
    jQuery('html, body').animate({scrollTop: elm.offset().top}, 500);
}

function AutoSizeNHSMenu() {
    if (jQuery("#nhs2-menu").length) {
        var _w = document.documentElement.clientWidth;
        var _dynamic = sanitize (jQuery("#V2MainNavigationDynamicWidth").val());
        if (_w > 1024) {
            if (_dynamic == "True") {
                jQuery("#nhs2-menu .main-nav").addClass("dynamicWidth");
            }
            jQuery("#header").removeClass("burger-menu");
        } else {
            if (_dynamic == "True") {
                jQuery("#nhs2-menu .main-nav").removeClass("dynamicWidth");
            }
            jQuery("#header").addClass("burger-menu");
        }
        jQuery("#nhs2-menu").css("visibility", "visible");
    }
    if (jQuery(".SubNavigation").length) {
        var _w = document.documentElement.clientWidth;
        if (_w > 1024) {
            jQuery(".SubNavigation").removeClass("bar-menu");
        } else {
            jQuery(".SubNavigation").addClass("bar-menu");
        }
        jQuery(".SubNavigation").css('visibility', 'visible');
    }
}

jQuery(window).resize(function () {
    AutoSizeNHSMenu();
});

function NHS_HighlightMainNavMenu() {
    var _p = location.pathname;
    _p = _p.replace(/Pages\//gi, "");
    var _t = _p.split("/");
    if (_t.length > 1) {
        var _v = _t[1].toLowerCase();
        var _ok = false;
        for (var i = 0; i < NHSMainMenu.length; i++) {
            if (NHSMainMenu[i].indexOf(_v) >= 0) {
                _ok = true;
                jQuery("#nhs2-menu .main-nav .menu:eq(" + i + ")").addClass("selected");
            }
        }
        if (!_ok) {
            if (_p != "" || _p != "/" || _p != "/home") {
                jQuery("#nhs2-menu .main-nav .menu:eq(0)").addClass("selected");
            }
        }
    }
}

function NHS_HighlightSubNavMenu() {
    var _p = location.pathname;
    _p = _p.replace("Pages/", "");
    _p = _p.replace(".aspx", "");
    var _ok = true;
    for (var i = 0; i < NHSSubMenu.length; i++) {
        if (NHSSubMenu[i].indexOf(_p) >= 0) {
            jQuery(".SubNavigation .links .level-0:eq(" + i + ")").addClass("selected");
            _ok = false;
        }
    }
    if (_ok) {
        for (var i = 0; i < NHSSubMenu.length; i++) {
            for (var j = 0; j < NHSSubMenu[i].length; j++) {
                if (_p.lastIndexOf(NHSSubMenu[i][j], 0) === 0) {
                    jQuery(".SubNavigation .links .level-0:eq(" + i + ")").addClass("selected");
                }
            }
        }
    }
}

function NHSAlignElmHeight() {
    var maxHeight = 0;
    var _elms = document.getElementsByClassName("NHSAlignHeight");
    for (var i = 0; i < _elms.length; i++) {
        var th = jQuery(".NHSAlignHeight:eq(" + i + ")").children().eq(0).children().eq(0).innerHeight();
        if (th > maxHeight) {
            maxHeight = th;
        }
    }
    for (var i = 0; i < _elms.length; i++) {
        jQuery(".NHSAlignHeight:eq(" + i + ")").children().eq(0).children().eq(0).innerHeight(maxHeight);
    }
}
