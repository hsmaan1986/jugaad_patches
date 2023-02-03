jQuery(document).ready(function() {
    if (jQuery(".questionnaireCarousel").length) {
        var _nbItems = jQuery(".questionnaireCarousel").find(".carousel-item-outer-container").length;
        if (_nbItems > 2) {
            _nbItems = 3;
        }
        jQuery(".questionnaireCarousel .owl-carousel").each(function(index) {
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
    jQuery('.horizontal.five .li').click(function(event) {
        if (jQuery(window).width() < 480) {
            var tabId = jQuery(this).attr('href');
            jQuery(tabId).css("display", "inline-block");
        }
    })
});