(function ($, Drupal) {
    Drupal.behaviors.nhsc_polling = {
        attach: function (context, settings) {

            function moveScroller() {
                var $anchor = jQuery("#scroller-anchor");
                var $scroller = jQuery('.poll_sticky');
                if ($scroller.length) {
                    var move = function() {
                        var st = jQuery(window).scrollTop();
                        var ot = $anchor.offset().top;
                        if(st > ot) {
                            $scroller.css({
                                position: "fixed",
                                top: "0px",
                                padding: "180px 0 0 0"
                            });
                        } else {
                            $scroller.css({
                                position: "relative",
                                top: "",
                                padding: ""
                            });
                        }
                    };
                    jQuery(window).scroll(move);
                    move();
                }

            }

            moveScroller();

        }
    };



})(jQuery, Drupal);