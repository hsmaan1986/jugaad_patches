! function($, window, undefined) {
    "use strict";
    $.fn.tabslet = function(options) {
        var defaults = {
                mouseevent: "click",
                activeclass: "active",
                attribute: "href",
                animation: !1,
                autorotate: !1,
                deeplinking: !1,
                pauseonhover: !0,
                delay: 2e3,
                active: 1,
                container: !1,
                controls: {
                    prev: ".prev",
                    next: ".next"
                }
            },
            options = $.extend(defaults, options);
        return this.each(function() {
            function deep_link() {
                var t = [];
                elements.find("a").each(function() {
                    t.push(jQuery(this).attr($this.opts.attribute));
                });
                var e = $.inArray(location.hash, t);
                return e > -1 ? e + 1 : $this.data("active") || options.active;
            }
            var $this = jQuery(this),
                _cache_li = [],
                _cache_div = [],
                _container = options.container ? jQuery(options.container) : $this,
                _tabs = _container.find("> div");
            _tabs.each(function() {
                jQuery(this).addClass("tab-display");
                _cache_div.push("tab-display");
            });
            var elements = $this.find("> ul > li"),
                i = options.active - 1;
            if (!$this.data("tabslet-init")) {
                $this.data("tabslet-init", !0), $this.opts = [], $.map(["mouseevent", "activeclass", "attribute", "animation", "autorotate", "deeplinking", "pauseonhover", "delay", "container"], function(t) {
                    $this.opts[t] = $this.data(t) || options[t];
                }), $this.opts.active = $this.opts.deeplinking ? deep_link() : $this.data("active") || options.active, _tabs.hide(), $this.opts.active && (_tabs.eq($this.opts.active - 1).show(), elements.eq($this.opts.active - 1).addClass(options.activeclass));
                var fn = eval(function(t, e) {
                        var s = e ? elements.find("a[" + $this.opts.attribute + '="' + e + '"]').parent() : jQuery(this);
                        s.trigger("_before"), elements.removeClass(options.activeclass), s.addClass(options.activeclass), _tabs.hide(), i = elements.index(s);
                        var o = e || s.find("a").attr($this.opts.attribute);
                        return $this.opts.deeplinking && (location.hash = o), $this.opts.animation ? _container.find(o).animate({
                            opacity: "show"
                        }, "slow", function() {
                            s.trigger("_after")
                        }) : (_container.find(o).show(), s.trigger("_after")), !1
                    }),
                    init = eval("elements." + $this.opts.mouseevent + "(fn)"),
                    t, forward = function() {
                        i = ++i % elements.length, "hover" == $this.opts.mouseevent ? elements.eq(i).trigger("mouseover") : elements.eq(i).click(), $this.opts.autorotate && (clearTimeout(t), t = setTimeout(forward, $this.opts.delay), $this.mouseover(function() {
                            $this.opts.pauseonhover && clearTimeout(t)
                        }))
                    };
                $this.opts.autorotate && (t = setTimeout(forward, $this.opts.delay), $this.hover(function() {
                    $this.opts.pauseonhover && clearTimeout(t)
                }, function() {
                    t = setTimeout(forward, $this.opts.delay)
                }), $this.opts.pauseonhover && $this.on("mouseleave", function() {
                    clearTimeout(t), t = setTimeout(forward, $this.opts.delay)
                }));
                var move = function(t) {
                    "forward" == t && (i = ++i % elements.length), "backward" == t && (i = --i % elements.length), elements.eq(i).click()
                };
                $this.find(options.controls.next).click(function() {
                    move("forward")
                }), $this.find(options.controls.prev).click(function() {
                    move("backward")
                }), $this.on("show", function(t, e) {
                    fn(t, e)
                }), $this.on("next", function() {
                    move("forward")
                }), $this.on("prev", function() {
                    move("backward")
                }), $this.on("destroy", function() {
                    jQuery(this).removeData().find("> ul li").each(function() {
                        jQuery(this).removeClass(options.activeclass)
                    }), _tabs.each(function(t) {
                        jQuery(this).removeClass("tab-display")
                    })
                })
            }
        })
    }, jQuery(document).ready(function() {
        jQuery('[data-toggle="tabslet"]').tabslet();
        jQuery('.horizontal.five li').click(function(event) {

            console.log('here');
            setTimeout(function() {
                var cpt = 0;
                jQuery('.nhs-freestyle-widget-content .horizontal.five li').each(function(index, element) {
                    cpt += 1;
                    if (jQuery(element).hasClass('active')) {
                        return false;
                    }
                });
                var titleHeight = [];
                jQuery('.tab-' + cpt + ' .questionnaireCarousel').find('.carousel-item-inner-container .title').each(function() {
                    titleHeight.push(jQuery(this).height());
                });
                var maxTitleHeight = Math.max.apply(Math, titleHeight);
                jQuery('.tab-' + cpt + ' .questionnaireCarousel').find('.carousel-item-inner-container .title').each(function() {
                    jQuery(this).css("min-height", maxTitleHeight);
                });
                var infoHeight = [];
                jQuery('.tab-' + cpt + ' .questionnaireCarousel').find('.carousel-item-inner-container .info').each(function() {
                    infoHeight.push(jQuery(this).height());
                });
                var maxInfoHeight = Math.max.apply(Math, infoHeight);
                jQuery('.tab-' + cpt + ' .questionnaireCarousel').find('.carousel-item-inner-container .info').each(function() {
                    jQuery(this).css("min-height", maxInfoHeight);
                });
                jQuery('.tab-' + cpt + ' .questionnaireCarousel').find('.carousel-item-inner-container .dropdown select').each(function() {
                    jQuery(this).css("display", "none");
                    jQuery(this).css("display", "inline-block");
                });
            }, 500);
        });
    })
}(jQuery);
jQuery(document).ready(function() {
    setTimeout(function() {
        jQuery('.tab-display').each(function() {
            var curIndex = 0;
            jQuery(jQuery('.owl-item').get().reverse()).each(function() {
                curIndex += 1;
                jQuery(this).css("z-index", curIndex);
                jQuery(this).css("position", "relative");
            });
        });
    }, 1000);
    jQuery('.banner-navbar .hamburger-menu-button').click(function(event) {
        event.preventDefault();
        if (jQuery('.banner-menu').is(":hidden")) {
            jQuery('.banner-menu').stop().slideToggle();
            jQuery('.banner-navbar .icons .hamburger-menu-button .hamburger-menu').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/home/hamburger-circle-close.png");
        } else {
            jQuery('.banner-menu').stop().slideToggle();
            jQuery('.banner-navbar .icons .hamburger-menu-button .hamburger-menu').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/home/hamburger-circle.png");
        }
    });
    jQuery('.main-navbar-inner .hamburger-menu-button').click(function(event) {
        event.preventDefault();
        if (jQuery('.navbar-menu').is(":hidden")) {
            jQuery('.navbar-menu').stop().slideToggle();
            jQuery('.main-navbar .icons .hamburger-menu-button .hamburger-menu').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/home/hamburger-circle-close.png");
        } else {
            jQuery('.navbar-menu').stop().slideToggle();
            jQuery('.main-navbar .icons .hamburger-menu-button .hamburger-menu').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/home/hamburger-circle.png");
        }
    });
    var wsize = screen.width;
    var hsize = screen.height;
    var wsize = Math.min(screen.width, screen.height);
    if (wsize > 800) {
        wsize = 800;
    }
    jQuery('#menu-item-recs').click(function(event) {
        var _questionnaireCookie = nhs_getCookie("questionnaire-results");
        if (_questionnaireCookie == null || _questionnaireCookie == "") {
            event.preventDefault();
            $.fancybox.open([{
                content: getAccessDeniedContent()
            }], {
                wrapCSS: 'nhs-fancybox',
                padding: 0,
                margin: 0,
                scrolling: 'no',
                closeBtn: true,
                minHeight: 100,
                modal: false
            });
        }
    });
    jQuery('#menu-item-tips').click(function(event) {
        var _questionnaireCookie = nhs_getCookie("questionnaire-results");
        if (_questionnaireCookie == null || _questionnaireCookie == "") {
            event.preventDefault();
            $.fancybox.open([{
                content: getAccessDeniedContent()
            }], {
                wrapCSS: 'nhs-fancybox',
                padding: 0,
                margin: 0,
                scrolling: 'no',
                closeBtn: true,
                minHeight: 100,
                modal: false
            });
        }
    });

    function getAccessDeniedContent() {
        var _content = '';
        _content += '<div class="access-denied-popup" style="width:' + wsize + 'px;">';
        _content += '<div class="access-denied-outer-wrapper">';
        _content += '<p>Para poder acceder a esta sección, antes deberás realizar el cuestionario.</p>'
        _content += '</div>';
        _content += '</div>';
        return _content;
    }
    jQuery('.banner-down-arrow a').click(function(event) {
        event.preventDefault();
        smoothScroll('start', 20, 'middle');
    });
    jQuery('.category-button').click(function(event) {
        event.preventDefault();
        jQuery('.category-button').each(function() {
            jQuery(this).removeClass("active");
        });
        jQuery('.pillar-jenga-piece-info-outer-container').each(function() {
            jQuery(this).css("display", "none");
        });
        jQuery(this).addClass("active");
        if (jQuery(window).width() < 480) {
            jQuery('.pillar-jenga-piece-info-outer-container.' + jQuery(this).attr('id')).css("display", "block");
            smoothScroll('info-' + jQuery(this).attr('id'));
        } else {
            jQuery('.pillar-jenga-piece-info-outer-container.' + jQuery(this).attr('id')).css("display", "inline-block");
        }
    });
    jQuery('#categories-dropdown').change(function(event) {
        jQuery('.pillar-jenga-piece-info-outer-container').each(function() {
            jQuery(this).css("display", "none");
        });
        var selection = ".pillar-jenga-piece-info-outer-container." + sanitize (jQuery('#categories-dropdown').val());
        if (jQuery(window).width() < 480) {
            jQuery(selection).css("display", "block");
            smoothScroll('info-' + sanitize (jQuery('#categories-dropdown').val()))
        } else {
            jQuery(selection).css("display", "inline-block");
        }
    });
    jQuery('.questionnaireCarousel').hover(function() {
        jQuery(this).find('.owl-prev').css("opacity", "1");
        jQuery(this).find('.owl-next').css("opacity", "1");
    }, function() {
        jQuery(this).find('.owl-prev').css("opacity", "0");
        jQuery(this).find('.owl-next').css("opacity", "0");
    });
    jQuery('#checkbox-boy').click(function(event) {
        jQuery(this).attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-checked.png");
        jQuery('#radio-girl').removeAttr("checked");
        jQuery('#checkbox-girl').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-empty.png");
        jQuery('#radio-boy').attr("checked", "checked");
    });
    jQuery('#checkbox-girl').click(function(event) {
        jQuery(this).attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-checked.png");
        jQuery('#radio-boy').removeAttr("checked");
        jQuery('#checkbox-boy').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-empty.png");
        jQuery('#radio-girl').attr("checked", "checked");
    });
    jQuery('#checkbox-3-6').click(function(event) {
        jQuery(this).attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-checked.png");
        jQuery('#radio-7-12').removeAttr("checked");
        jQuery('#checkbox-7-12').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-empty.png");
        jQuery('#radio-3-6').attr("checked", "checked");
    });
    jQuery('#checkbox-7-12').click(function(event) {
        jQuery(this).attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-checked.png");
        jQuery('#radio-3-6').removeAttr("checked");
        jQuery('#checkbox-3-6').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/checkbox-empty.png");
        jQuery('#radio-7-12').attr("checked", "checked");
    });
    jQuery('.tabs.tabs_default ul li a').click(function(event) {
        jQuery('.tabs.tabs_default ul li a').each(function() {
            jQuery(this).find('img').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/section-counter.png");
        });
        jQuery(this).find('img').attr("src", "/modules/custom/nhsc_learn_to_grow_survey/static_assets/asset-library/PublishingImages/aprendiendo-a-crecer/cuestionario/section-counter-active.png");
    });
    jQuery('.daily-weekly-switch').change(function() {
        if (this.checked) {
            jQuery(this).parent().parent().parent().find('.switch-daily').css({
                "color": "#142654",
                "font-weight": "normal"
            });
            jQuery(this).parent().parent().parent().find('.switch-weekly').css({
                "color": "#357ede",
                "font-weight": "bold"
            });
        } else {
            jQuery(this).parent().parent().parent().find('.switch-daily').css({
                "color": "#357ede",
                "font-weight": "bold"
            });
            jQuery(this).parent().parent().parent().find('.switch-weekly').css({
                "color": "#142654",
                "font-weight": "normal"
            });
        }
    });
    jQuery('.tooltip-button').click(function(event) {
        event.preventDefault();
    });
    var curCountLactose = 0;
    var selectionMadeMilk = false;
    var selectionMadeYogurt = false;
    var selectionMadeSourCream = false;
    var selectionMadeCheese = false;
    jQuery('#portions-milk').change(function(event) {
        if (jQuery('#portions-milk').val() != 0 && !selectionMadeMilk) {
            selectionMadeMilk = true;
            curCountLactose += 1;
        } else if (jQuery('#portions-milk').val() == 0 && curCountLactose > 0) {
            selectionMadeMilk = false;
            curCountLactose -= 1;
        }
        jQuery('#lactose-tab').find('.current-count').html(curCountLactose);
    });
    jQuery('#portions-yogurt').change(function(event) {
        if (jQuery('#portions-yogurt').val() != 0 && !selectionMadeYogurt) {
            selectionMadeYogurt = true;
            curCountLactose += 1;
        } else if (jQuery('#portions-yogurt').val() == 0 && curCountLactose > 0) {
            selectionMadeYogurt = false;
            curCountLactose -= 1;
        }
        jQuery('#lactose-tab').find('.current-count').html(curCountLactose);
    });
    jQuery('#portions-sourCream').change(function(event) {
        if (jQuery('#portions-sourCream').val() != 0 && !selectionMadeSourCream) {
            selectionMadeSourCream = true;
            curCountLactose += 1;
        } else if (jQuery('#portions-sourCream').val() == 0 && curCountLactose > 0) {
            selectionMadeSourCream = false;
            curCountLactose -= 1;
        }
        jQuery('#lactose-tab').find('.current-count').html(curCountLactose);
    });
    jQuery('#portions-cheese').change(function(event) {
        if (jQuery('#portions-cheese').val() != 0 && !selectionMadeCheese) {
            selectionMadeCheese = true;
            curCountLactose += 1;
        } else if (jQuery('#portions-cheese').val() == 0 && curCountLactose > 0) {
            selectionMadeCheese = false;
            curCountLactose -= 1;
        }
        jQuery('#lactose-tab').find('.current-count').html(curCountLactose);
    });
    var curCountProtein = 0;
    var selectionMadeMeat = false;
    var selectionMadeSausage = false;
    var selectionMadeFish = false;
    var selectionMadeEggs = false;
    var selectionMadeVegetables = false;
    var selectionMadeSeafood = false;
    var selectionMadeNuts = false;
    jQuery('#portions-meat').change(function(event) {
        if (jQuery('#portions-meat').val() != 0 && !selectionMadeMeat) {
            selectionMadeMeat = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-meat').val() == 0 && curCountProtein > 0) {
            selectionMadeMilk = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-sausage').change(function(event) {
        if (jQuery('#portions-sausage').val() != 0 && !selectionMadeSausage) {
            selectionMadeSausage = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-sausage').val() == 0 && curCountProtein > 0) {
            selectionMadeSausage = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-fish').change(function(event) {
        if (jQuery('#portions-fish').val() != 0 && !selectionMadeFish) {
            selectionMadeFish = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-fish').val() == 0 && curCountProtein > 0) {
            selectionMadeFish = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-eggs').change(function(event) {
        if (jQuery('#portions-eggs').val() != 0 && !selectionMadeEggs) {
            selectionMadeEggs = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-eggs').val() == 0 && curCountProtein > 0) {
            selectionMadeEggs = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-vegetables').change(function(event) {
        if (jQuery('#portions-vegetables').val() != 0 && !selectionMadeVegetables) {
            selectionMadeVegetables = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-vegetables').val() == 0 && curCountProtein > 0) {
            selectionMadeVegetables = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-seafood').change(function(event) {
        if (jQuery('#portions-seafood').val() != 0 && !selectionMadeSeafood) {
            selectionMadeSeafood = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-seafood').val() == 0 && curCountProtein > 0) {
            selectionMadeSeafood = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    jQuery('#portions-nuts').change(function(event) {
        if (jQuery('#portions-nuts').val() != 0 && !selectionMadeNuts) {
            selectionMadeNuts = true;
            curCountProtein += 1;
        } else if (jQuery('#portions-nuts').val() == 0 && curCountProtein > 0) {
            selectionMadeNuts = false;
            curCountProtein -= 1;
        }
        jQuery('#protein-tab').find('.current-count').html(curCountProtein);
    });
    var curCountVegetables = 0;
    var selectionMadeSalad = false;
    var selectionMadeRawVegetables = false;
    var selectionMadeBoiledVegetables = false;
    var selectionMadeCookedVegetables = false;
    var selectionMadeCreamedVegetables = false;
    var selectionMadePureeSoups = false;
    jQuery('#portions-salad').change(function(event) {
        if (jQuery('#portions-salad').val() != 0 && !selectionMadeSalad) {
            selectionMadeSalad = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-salad').val() == 0 && curCountVegetables > 0) {
            selectionMadeSalad = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    jQuery('#portions-rawVegetables').change(function(event) {
        if (jQuery('#portions-rawVegetables').val() != 0 && !selectionMadeRawVegetables) {
            selectionMadeRawVegetables = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-rawVegetables').val() == 0 && curCountVegetables > 0) {
            selectionMadeRawVegetables = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    jQuery('#portions-boiledVegetables').change(function(event) {
        if (jQuery('#portions-boiledVegetables').val() != 0 && !selectionMadeBoiledVegetables) {
            selectionMadeBoiledVegetables = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-boiledVegetables').val() == 0 && curCountVegetables > 0) {
            selectionMadeBoiledVegetables = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    jQuery('#portions-cookedVegetables').change(function(event) {
        if (jQuery('#portions-cookedVegetables').val() != 0 && !selectionMadeCookedVegetables) {
            selectionMadeCookedVegetables = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-cookedVegetables').val() == 0 && curCountVegetables > 0) {
            selectionMadeCookedVegetables = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    jQuery('#portions-creamedVegetables').change(function(event) {
        if (jQuery('#portions-creamedVegetables').val() != 0 && !selectionMadeCreamedVegetables) {
            selectionMadeCreamedVegetables = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-creamedVegetables').val() == 0 && curCountVegetables > 0) {
            selectionMadeCreamedVegetables = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    jQuery('#portions-pureeSoups').change(function(event) {
        if (jQuery('#portions-pureeSoups').val() != 0 && !selectionMadePureeSoups) {
            selectionMadePureeSoups = true;
            curCountVegetables += 1;
        } else if (jQuery('#portions-pureeSoups').val() == 0 && curCountVegetables > 0) {
            selectionMadePureeSoups = false;
            curCountVegetables -= 1;
        }
        jQuery('#vegetables-tab').find('.current-count').html(curCountVegetables);
    });
    var curCountFruits = 0;
    var selectionMadeRedBerries = false;
    var selectionMadeFruitGroup1 = false;
    var selectionMadeFruitGroup2 = false;
    var selectionMadeFruitGroup3 = false;
    var selectionMadePureeFruits = false;
    var selectionMadeDriedFruits = false;
    var selectionMadeFruitSmoothies = false;
    jQuery('#portions-redBerries').change(function(event) {
        if (jQuery('#portions-redBerries').val() != 0 && !selectionMadeRedBerries) {
            selectionMadeRedBerries = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-redBerries').val() == 0 && curCountFruits > 0) {
            selectionMadeRedBerries = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-fruitGroup1').change(function(event) {
        if (jQuery('#portions-fruitGroup1').val() != 0 && !selectionMadeFruitGroup1) {
            selectionMadeFruitGroup1 = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-fruitGroup1').val() == 0 && curCountFruits > 0) {
            selectionMadeFruitGroup1 = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-fruitGroup2').change(function(event) {
        if (jQuery('#portions-fruitGroup2').val() != 0 && !selectionMadeFruitGroup2) {
            selectionMadeFruitGroup2 = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-fruitGroup2').val() == 0 && curCountFruits > 0) {
            selectionMadeFruitGroup2 = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-fruitGroup3').change(function(event) {
        if (jQuery('#portions-fruitGroup3').val() != 0 && !selectionMadeFruitGroup3) {
            selectionMadeFruitGroup3 = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-fruitGroup3').val() == 0 && curCountFruits > 0) {
            selectionMadeFruitGroup3 = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-pureeFruits').change(function(event) {
        if (jQuery('#portions-pureeFruits').val() != 0 && !selectionMadePureeFruits) {
            selectionMadePureeFruits = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-pureeFruits').val() == 0 && curCountFruits > 0) {
            selectionMadePureeFruits = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-driedFruits').change(function(event) {
        if (jQuery('#portions-driedFruits').val() != 0 && !selectionMadeDriedFruits) {
            selectionMadeDriedFruits = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-driedFruits').val() == 0 && curCountFruits > 0) {
            selectionMadeDriedFruits = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    jQuery('#portions-fruitSmoothies').change(function(event) {
        if (jQuery('#portions-fruitSmoothies').val() != 0 && !selectionMadeFruitSmoothies) {
            selectionMadeFruitSmoothies = true;
            curCountFruits += 1;
        } else if (jQuery('#portions-fruitSmoothies').val() == 0 && curCountFruits > 0) {
            selectionMadeFruitSmoothies = false;
            curCountFruits -= 1;
        }
        jQuery('#fruit-tab').find('.current-count').html(curCountFruits);
    });
    var curCountCereal = 0;
    var selectionMadeRice = false;
    var selectionMadeBread = false;
    var selectionMadePasta = false;
    var selectionMadePotatoes = false;
    var selectionMadeCereal = false;
    var selectionMadeBiscuits = false;
    var selectionMadeOtherCereal = false;
    jQuery('#portions-rice').change(function(event) {
        if (jQuery('#portions-rice').val() != 0 && !selectionMadeRice) {
            selectionMadeRice = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-rice').val() == 0 && curCountCereal > 0) {
            selectionMadeRice = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-bread').change(function(event) {
        if (jQuery('#portions-bread').val() != 0 && !selectionMadeBread) {
            selectionMadeBread = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-bread').val() == 0 && curCountCereal > 0) {
            selectionMadeBread = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-pasta').change(function(event) {
        if (jQuery('#portions-pasta').val() != 0 && !selectionMadePasta) {
            selectionMadePasta = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-pasta').val() == 0 && curCountCereal > 0) {
            selectionMadePasta = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-potatoes').change(function(event) {
        if (jQuery('#portions-potatoes').val() != 0 && !selectionMadePotatoes) {
            selectionMadePotatoes = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-potatoes').val() == 0 && curCountCereal > 0) {
            selectionMadePotatoes = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-cereal').change(function(event) {
        if (jQuery('#portions-cereal').val() != 0 && !selectionMadeCereal) {
            selectionMadeCereal = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-cereal').val() == 0 && curCountCereal > 0) {
            selectionMadeCereal = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-biscuits').change(function(event) {
        if (jQuery('#portions-biscuits').val() != 0 && !selectionMadeBiscuits) {
            selectionMadeBiscuits = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-biscuits').val() == 0 && curCountCereal > 0) {
            selectionMadeBiscuits = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });
    jQuery('#portions-otherCereal').change(function(event) {
        if (jQuery('#portions-otherCereal').val() != 0 && !selectionMadeOtherCereal) {
            selectionMadeOtherCereal = true;
            curCountCereal += 1;
        } else if (jQuery('#portions-otherCereal').val() == 0 && curCountCereal > 0) {
            selectionMadeOtherCereal = false;
            curCountCereal -= 1;
        }
        jQuery('#cereal-tab').find('.current-count').html(curCountCereal);
    });

    function GetGender() {
        if (jQuery('#radio-boy').is(':checked')) {
            return "M";
        } else if (jQuery('#radio-girl').is(':checked')) {
            return "F";
        }
    }

    function GetAge() {
        if (jQuery('#radio-3-6').is(':checked')) {
            return "3-6";
        } else if (jQuery('#radio-7-12').is(':checked')) {
            return "7-12";
        }
    }
    jQuery('#results-btn').click(function(event) {
        event.preventDefault();
        jQuery('.name-error').css("display", "none");
        jQuery('.gender-error').css("display", "none");
        jQuery('.age-error').css("display", "none");
        var QuestionnaireAnswers = {
            GeneralInfo: {
                Name: jQuery('#name input').val(),
                Gender: GetGender(),
                AgeGroup: GetAge()
            },
            LactoseAnswers: {
                Milk: {
                    "Amount": parseInt(jQuery('#portions-milk').val()),
                    "Weekly": jQuery('#portions-milk').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-milk').val()), jQuery('#portions-milk').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Yogurt: {
                    "Amount": parseInt(jQuery('#portions-yogurt').val()),
                    "Weekly": jQuery('#portions-yogurt').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-yogurt').val()), jQuery('#portions-yogurt').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                SourCream: {
                    "Amount": parseInt(jQuery('#portions-sourCream').val()),
                    "Weekly": jQuery('#portions-sourCream').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-sourCream').val()), jQuery('#portions-sourCream').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Cheese: {
                    "Amount": parseInt(jQuery('#portions-cheese').val()),
                    "Weekly": jQuery('#portions-cheese').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-cheese').val()), jQuery('#portions-cheese').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                }
            },
            ProteinAnswers: {
                Meat: {
                    "Amount": parseInt(jQuery('#portions-meat').val()),
                    "Weekly": jQuery('#portions-meat').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-meat').val()), jQuery('#portions-meat').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Sausage: {
                    "Amount": parseInt(jQuery('#portions-sausage').val()),
                    "Weekly": jQuery('#portions-sausage').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-sausage').val()), jQuery('#portions-sausage').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Fish: {
                    "Amount": parseInt(jQuery('#portions-fish').val()),
                    "Weekly": jQuery('#portions-fish').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-fish').val()), jQuery('#portions-fish').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Eggs: {
                    "Amount": parseInt(jQuery('#portions-eggs').val()),
                    "Weekly": jQuery('#portions-eggs').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-eggs').val()), jQuery('#portions-eggs').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Vegetables: {
                    "Amount": parseInt(jQuery('#portions-vegetables').val()),
                    "Weekly": jQuery('#portions-vegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-vegetables').val()), jQuery('#portions-vegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Seafood: {
                    "Amount": parseInt(jQuery('#portions-seafood').val()),
                    "Weekly": jQuery('#portions-seafood').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-seafood').val()), jQuery('#portions-seafood').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Nuts: {
                    "Amount": parseInt(jQuery('#portions-nuts').val()),
                    "Weekly": jQuery('#portions-nuts').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-nuts').val()), jQuery('#portions-nuts').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                }
            },
            VegetablesAnswers: {
                Salad: {
                    "Amount": parseInt(jQuery('#portions-salad').val()),
                    "Weekly": jQuery('#portions-salad').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-salad').val()), jQuery('#portions-salad').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                RawVegetables: {
                    "Amount": parseInt(jQuery('#portions-rawVegetables').val()),
                    "Weekly": jQuery('#portions-rawVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-rawVegetables').val()), jQuery('#portions-rawVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                BoiledVegetables: {
                    "Amount": parseInt(jQuery('#portions-boiledVegetables').val()),
                    "Weekly": jQuery('#portions-boiledVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-boiledVegetables').val()), jQuery('#portions-boiledVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                CookedVegetables: {
                    "Amount": parseInt(jQuery('#portions-cookedVegetables').val()),
                    "Weekly": jQuery('#portions-cookedVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-cookedVegetables').val()), jQuery('#portions-cookedVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                CreamedVegetables: {
                    "Amount": parseInt(jQuery('#portions-creamedVegetables').val()),
                    "Weekly": jQuery('#portions-creamedVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-creamedVegetables').val()), jQuery('#portions-creamedVegetables').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                PureeSoups: {
                    "Amount": parseInt(jQuery('#portions-pureeSoups').val()),
                    "Weekly": jQuery('#portions-pureeSoups').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-pureeSoups').val()), jQuery('#portions-pureeSoups').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                }
            },
            FruitsAnswers: {
                RedBerries: {
                    "Amount": parseInt(jQuery('#portions-redBerries').val()),
                    "Weekly": jQuery('#portions-redBerries').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-redBerries').val()), jQuery('#portions-redBerries').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                FruitGroup1: {
                    "Amount": parseInt(jQuery('#portions-fruitGroup1').val()),
                    "Weekly": jQuery('#portions-fruitGroup1').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-fruitGroup1').val()), jQuery('#portions-fruitGroup1').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                FruitGroup2: {
                    "Amount": parseInt(jQuery('#portions-fruitGroup2').val()),
                    "Weekly": jQuery('#portions-fruitGroup2').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-fruitGroup2').val()), jQuery('#portions-fruitGroup2').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                FruitGroup3: {
                    "Amount": parseInt(jQuery('#portions-fruitGroup3').val()),
                    "Weekly": jQuery('#portions-fruitGroup3').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-fruitGroup3').val()), jQuery('#portions-fruitGroup3').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                PureeFruits: {
                    "Amount": parseInt(jQuery('#portions-pureeFruits').val()),
                    "Weekly": jQuery('#portions-pureeFruits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-pureeFruits').val()), jQuery('#portions-pureeFruits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                DriedFruits: {
                    "Amount": parseInt(jQuery('#portions-driedFruits').val()),
                    "Weekly": jQuery('#portions-driedFruits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-driedFruits').val()), jQuery('#portions-driedFruits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                FruitSmoothies: {
                    "Amount": parseInt(jQuery('#portions-fruitSmoothies').val()),
                    "Weekly": jQuery('#portions-fruitSmoothies').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-fruitSmoothies').val()), jQuery('#portions-fruitSmoothies').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                }
            },
            CerealAnswers: {
                Rice: {
                    "Amount": parseInt(jQuery('#portions-rice').val()),
                    "Weekly": jQuery('#portions-rice').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-rice').val()), jQuery('#portions-rice').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Bread: {
                    "Amount": parseInt(jQuery('#portions-bread').val()),
                    "Weekly": jQuery('#portions-bread').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-bread').val()), jQuery('#portions-bread').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Pasta: {
                    "Amount": parseInt(jQuery('#portions-pasta').val()),
                    "Weekly": jQuery('#portions-pasta').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-pasta').val()), jQuery('#portions-pasta').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Potatoes: {
                    "Amount": parseInt(jQuery('#portions-potatoes').val()),
                    "Weekly": jQuery('#portions-potatoes').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-potatoes').val()), jQuery('#portions-potatoes').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Cereal: {
                    "Amount": parseInt(jQuery('#portions-cereal').val()),
                    "Weekly": jQuery('#portions-cereal').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-cereal').val()), jQuery('#portions-cereal').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                Biscuits: {
                    "Amount": parseInt(jQuery('#portions-biscuits').val()),
                    "Weekly": jQuery('#portions-biscuits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-biscuits').val()), jQuery('#portions-biscuits').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                },
                OtherCereal: {
                    "Amount": parseInt(jQuery('#portions-otherCereal').val()),
                    "Weekly": jQuery('#portions-otherCereal').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'),
                    "ConvertedAmount": Convert(parseInt(jQuery('#portions-otherCereal').val()), jQuery('#portions-otherCereal').parent().parent().find(jQuery('.daily-weekly-switch')).is(':checked'))
                }
            },
            Scores: {
                LactoseScore: 0,
                ProteinScore: 0,
                VegetablesScore: 0,
                FruitsScore: 0,
                CerealScore: 0,
                OverallScore: 0
            },
            Deficiencies: []
        }
        if (QuestionnaireAnswers.GeneralInfo.Name == "") {
            jQuery('.name-error').css("display", "block");
            document.getElementById('name').scrollIntoView();
        } else if (QuestionnaireAnswers.GeneralInfo.Gender == "") {
            jQuery('.gender-error').css("display", "block");
            document.getElementById('gender').scrollIntoView();
        } else if (QuestionnaireAnswers.GeneralInfo.Age == "") {
            jQuery('.age-error').css("display", "block");
            document.getElementById('age').scrollIntoView();
        } else {
            var result = CalculateResults(QuestionnaireAnswers);
            nhs_writeCookiePlusOneYear("questionnaire-results", JSON.stringify(QuestionnaireAnswers), "/");
            window.location.href = '/aprendiendo-a-crecer/recomendaciones-personalizadas';
        }
    });

    function Convert(Amount, WeeklyValue) {
        if (WeeklyValue == true) {
            return Amount;
        } else {
            return (Amount) * 7;
        }
    }

    function CalculateResults(Answers) {
        var C = CheckValue(Answers.LactoseAnswers.Milk.ConvertedAmount + Answers.LactoseAnswers.Yogurt.ConvertedAmount + Answers.LactoseAnswers.SourCream.ConvertedAmount + Answers.LactoseAnswers.Cheese.ConvertedAmount, 28);
        var F = CheckValue(Answers.ProteinAnswers.Meat.ConvertedAmount + Answers.ProteinAnswers.Sausage.ConvertedAmount + Answers.ProteinAnswers.Fish.ConvertedAmount + Answers.ProteinAnswers.Eggs.ConvertedAmount + Answers.ProteinAnswers.Vegetables.ConvertedAmount + Answers.ProteinAnswers.Seafood.ConvertedAmount + Answers.ProteinAnswers.Nuts.ConvertedAmount, 14);
        var L = CheckValue(Answers.VegetablesAnswers.Salad.ConvertedAmount + Answers.VegetablesAnswers.RawVegetables.ConvertedAmount + Answers.VegetablesAnswers.BoiledVegetables.ConvertedAmount + Answers.VegetablesAnswers.CookedVegetables.ConvertedAmount + Answers.VegetablesAnswers.CreamedVegetables.ConvertedAmount + Answers.VegetablesAnswers.PureeSoups.ConvertedAmount, 21);
        var I = CheckValue(Answers.FruitsAnswers.RedBerries.ConvertedAmount + Answers.FruitsAnswers.FruitGroup1.ConvertedAmount + Answers.FruitsAnswers.FruitGroup2.ConvertedAmount + Answers.FruitsAnswers.FruitGroup3.ConvertedAmount + Answers.FruitsAnswers.PureeFruits.ConvertedAmount + Answers.FruitsAnswers.DriedFruits.ConvertedAmount + Answers.FruitsAnswers.FruitSmoothies.ConvertedAmount, 21);
        var O = CheckValue(Answers.CerealAnswers.Rice.ConvertedAmount + Answers.CerealAnswers.Bread.ConvertedAmount + Answers.CerealAnswers.Pasta.ConvertedAmount + Answers.CerealAnswers.Potatoes.ConvertedAmount + Answers.CerealAnswers.Cereal.ConvertedAmount + Answers.CerealAnswers.Biscuits.ConvertedAmount + Answers.CerealAnswers.OtherCereal.ConvertedAmount, 42);
        Answers.Scores.LactoseScore = C;
        if (CheckDeficiency(C, 14)) {
            Answers.Deficiencies.push("Lácteos");
        }
        Answers.Scores.ProteinScore = F;
        if (CheckDeficiency(F, 14)) {
            Answers.Deficiencies.push("Carne, Pescado, Huevos y Legumbres");
        }
        Answers.Scores.VegetablesScore = L;
        if (CheckDeficiency(L, 14)) {
            Answers.Deficiencies.push("Verduras");
        }
        Answers.Scores.FruitsScore = I;
        if (CheckDeficiency(I, 14)) {
            Answers.Deficiencies.push("Frutas");
        }
        Answers.Scores.CerealScore = O;
        if (CheckDeficiency(O, 28)) {
            Answers.Deficiencies.push("Cereales");
        }
        var X = C + F + L + I + O;
        Answers.Scores.OverallScore = X;
        return X;
    }

    function CheckValue(value, limit) {
        if (value > limit) {
            value = limit;
        }
        return value;
    }

    function CheckDeficiency(value, limit) {
        if (value < limit) {
            return true;
        }
        return false;
    }
    jQuery('.block .alimentacion').click(function(event) {
        var Results = JSON.parse(unescape(nhs_getCookie("questionnaire-results")));
        event.preventDefault();
        if (Results.GeneralInfo.AgeGroup == "3-6") {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/alimentacion-3-6.aspx';
        } else {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/alimentacion-7-12.aspx';
        }
    });
    jQuery('.block .deporte').click(function(event) {
        var Results = JSON.parse(unescape(nhs_getCookie("questionnaire-results")));
        event.preventDefault();
        if (Results.GeneralInfo.AgeGroup == "3-6") {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/deporte-3-6.aspx';
        } else {
            window.location.href = '/aprendiendo-a-crecer/Pages/tips/deporte-7-12.aspx';
        }
    });

    function currentYPosition() {
        if (self.pageYOffset) return self.pageYOffset;
        if (document.documentElement && document.documentElement.scrollTop)
            return document.documentElement.scrollTop;
        if (document.body.scrollTop) return document.body.scrollTop;
        return 0;
    }

    function elmYPosition(eID, position) {
        var elm = document.getElementById(eID);
        var y = elm.offsetTop;
        var node = elm;
        while (node.offsetParent && node.offsetParent != document.body) {
            node = node.offsetParent;
            y += node.offsetTop;
        }
        if (position == "middle") {
            return y - 200;
        }
        return y;
    }

    function smoothScroll(eID, speed, position) {
        var startY = currentYPosition();
        var stopY = elmYPosition(eID, position);
        var distance = stopY > startY ? stopY - startY : startY - stopY;
        if (distance < 100) {
            scrollTo(0, stopY);
            return;
        }
        if (speed == null) {
            speed = Math.round(distance / 100);
            if (speed >= 20) speed = 20;
        }
        var step = Math.round(distance / 25);
        var leapY = stopY > startY ? startY + step : startY - step;
        var timer = 0;
        if (stopY > startY) {
            for (var i = startY; i < stopY; i += step) {
                setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
                leapY += step;
                if (leapY > stopY) leapY = stopY;
                timer++;
            }
            return;
        }
        for (var i = startY; i > stopY; i -= step) {
            setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
            leapY -= step;
            if (leapY < stopY) leapY = stopY;
            timer++;
        }
        return false;
    }
});
