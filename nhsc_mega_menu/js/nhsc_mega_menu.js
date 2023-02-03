
(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.nhscMegaMebuBehavior = {
    attach: function (context, settings) {

        var size;

        // function smallerMenu() {
        //     var sc = $(window).scrollTop();
        //     if (sc > 40) {
        //         $('#header-sroll').addClass('small');
        //     }else {
        //         $('#header-sroll').removeClass('small');
        //     }
        // }

        function windowSize() {
            size = $(document).width();
            if (size >= 1025) {
                $('nav').removeClass('open-menu');
                $('.hamburger-menu .bar').removeClass('animate');
            }
        };

            // ANIMATE HAMBURGER MENU
            $('.hamburger-menu').on('click', function() {

                $('.hamburger-menu .bar').toggleClass('animate');

                //STOP PAGE FROM SCROLLING WHEN MOBILE MENU IS OPEN
                $('body').toggleClass('freezeScroll');
                $('html').toggleClass('freezeScroll');

                if($('nav').hasClass('open-menu')){
                    $('ul .sub-menu').removeClass('open-sub')
                    $('nav').removeClass('open-menu');
                    $('.navbar-header').removeClass('move-up');

                } else {
                    $('nav').toggleClass('open-menu');
                    $('.navbar-header').addClass('move-up');
                    $('.nhsc-new-search').removeClass('hide-me');
                }
            });

            $('#block-nhscmegamenublock li ul').parent().addClass('hasChild');
            $('#block-nhscmegamenublock ul li:has(ul)').addClass('has_child');


            $('.back').on('click', function(e) {

                if(size <= 1025){

                    $(this).parent().removeClass('open-sub');

                    if(($(this).parents().eq(3).attr('class')) === 'menu-header-container'){

                        $('.nhsc-new-search').removeClass('hide-me');
                        $('#nhsc-mega-menu-filters.filter-body').hide();

                    }

                }
            });

            $('nav .over-menu').on('click', function() {
                $('nav').removeClass('open-menu');
                $('.bar').removeClass('animate');
                $('nhsc-new-search').removeClass('.hide-me');
            });

            var nav_level1 = $('#cd-primary-nav > li');
            var nav_level2 = $('.block-nhsc-mega-menu-block ul li ul li');
            var li_menu_hover = $('.level-2 > li > a');

            function width_fix() {
                console.log("width fix");

                $whidt_item = $(this).width();
                $whidt_item = $whidt_item-8;

                $prevEl = $(this).prev('li');
                $preWidth = $(this).prev('li').width();
                var pos = $(this).position();
                pos = pos.left+4;
                $('.header .desk-menu .menu-container .menu>li.line').css({
                    width:  $whidt_item,
                    left: pos,
                    opacity: 1
                });
            }

            $(document).ready(function(){
                windowSize();

              $('#block-nhscmegamenublock li a').on('click', function(e) {
                if ( $(this).parent().hasClass('hasChild') ) {
                  e.preventDefault();
                  $(this).next('ul').addClass('open-sub');

                  if (size >= 1024) {
                    if ($(this).attr('href') && $(this).attr('href') !== '#') {
                      window.location.href = $(this).attr('href');
                    }
                  }

                  if (size <= 1024){
                    $('.nhsc-new-search').addClass('hide-me');
                  }
                } else {
                  window.location.href = $(this).attr('href');
                }

                //$(this).next('ul').addClass('open-sub');

                // open filters on mobile
                $('.icon-open-close').addClass('open');


              });


              // hover intent first level
              nav_level1.hoverIntent({
                  over: function () {
                    if (size > 1024){
                      $(this).children('ul.sub-menu').addClass('show-menu-block');
                      $('.level-2 > li > a').removeClass('active');
                    }
                  },
                  timeout: 300,// delay
                  out: function() {
                      $("ul.sub-menu", this).removeClass('show-menu-block');
                  }
              });

              nav_level2.hoverIntent({
                  over: function () {
                    if (size > 1024) {
                      $(this).children('ul.sub-menu').addClass('show-menu-block');
                    }
                  },
                  timeout: 300,// delay
                  out: function() {
                      $("ul.sub-menu", this).removeClass('show-menu-block');
                  }
              });


              // level 2
              $('.level-2 > li > a').hoverIntent({
                  over: function () {
                    if (size > 1024) {
                      $('.submenu-link.active').removeClass('active');
                      $(this).addClass('menu-items-hover active');
                      $('.level-3 > li > a').removeClass('menu-items-hover active1');
                    }
                  },
                  timeout: 300,// delay
                  out: function() {
                      $(this).removeClass('menu-items-hover');
                  }
              });

              //level 3
              $('.level-3 > li > a').hoverIntent({
                  over: function () {

                    if (size > 1024) {
                      $('.submenu-link.active1').removeClass('active1');
                      $(this).addClass('menu-items-hover active1');
                      $('.level-4 > li > a').removeClass('menu-items-hover active2');
                    }

                  },
                  timeout: 300,// delay
                  out: function() {
                    // $('.level-3 > li > a').removeClass('menu-items-hover active1');
                    $(this).removeClass('menu-items-hover');
                  }
              });

              //level 4
              $('.level-4 > li > a').hoverIntent({
                  over: function () {
                    if (size > 1024) {
                      // console.log('parents', $(this).parent().parent().parent().children('a'));
                      // $(this).parent().parent().parent().children('a').addClass('active1');
                      $('.submenu-link.active2').removeClass('active2');
                      $(this).addClass('menu-items-hover active2');
                    }

                  },
                  timeout: 300,// delay
                  out: function() {
                      $(this).removeClass('menu-items-hover');
                  }
              });

            });

            // $(window).scroll(function(){
            //     smallerMenu();
            // });

            $(window).resize(function(){
                windowSize();
            });

            $('#nhsc-mega-menu-filters input[type="checkbox"]').bind('change', function() {

                var filtersApplied = $('#nhsc-mega-menu-filters input[type="checkbox"]').filter(':checked').length;
                var totalSelected = parseInt(filtersApplied);

                if (totalSelected > 0){
                    $('span#filterCount').html(totalSelected);
                } else {
                    $('span#filterCount').html('');
                }

            });

            $('button.js-form-reset').hide();
            $('.icon-open-close').on("click", function () {
                $(this).toggleClass('open');
                $('.filter-body').toggle();

                var isFilterBodyVisible = $('.filter-body').is(':visible');
                if (isFilterBodyVisible === true) {
                    $('button.js-form-reset').show();
                } else {
                    $('button.js-form-reset').hide();
                }

            });

            /** start **/
            $('#nhsc-mega-menu-filters button.js-form-submit').click(function(){
                var selected_brands = [];
                console.log('selected_brands', selected_brands)

                $('#nhsc-mega-menu-filters input[type=checkbox]').each(function(){
                    if (this.checked){
                        selected_brands.push($(this).attr('value'));
                    }
                });

                $('.js-form-item-image').hide();

                selected_brands.filter(function(item){
                    $('.js-form-item-image').each(function(){
                        if($(this).attr('data-brands').split(', ').indexOf(item) > -1){
                            $(this).show();
                        }
                    });
                });

                var filtersApplied = $('#nhsc-mega-menu-filters input[type="checkbox"]').filter(':checked').length;
                var totalSelected = parseInt(filtersApplied);
                if (totalSelected > 0) {

                } else {
                    $('.js-form-item-image').show();
                }

            });

            /** end **/

            $('.block-nhsc-mega-menu-block button.js-form-reset').click(function(){

                $('span#filterCount').html('');
                $('.js-form-item-image').show();

                $('#nhsc-mega-menu-filters input').filter(':checkbox').prop('checked',false);

            });

            $('#nhsc-mega-menu-filters .button.js-form-submit').click(function(){
                $('#nhsc-mega-menu-filters.filter-body').hide();
                $('button.js-form-reset').hide();
            });

            $("#cd-primary-nav ul").addClass(function() {
                var depth = $(this).parents("ul").length;
                return "level-" + (depth + 1);
            });

            setTimeout(function(){
              var $menuBackText = (drupalSettings.menuBackText) ? drupalSettings.menuBackText : 'Back';
              $('.back-button-js a').append($menuBackText);
            },3000);

        }
    };

})(jQuery, Drupal, drupalSettings );
