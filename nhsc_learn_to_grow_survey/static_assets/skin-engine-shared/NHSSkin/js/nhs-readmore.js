var $el, $ps, $up, totalHeight;
jQuery(document).on("click", ".nhs_expandable .readmore .button", function () {
    $el = jQuery(this);
    $p = $el.parent();
    $up = $p.parent();
    if (!$up.hasClass("expanded")) {
        totalHeight = $up[0].scrollHeight + $el.height();
        $up.css({"height": $up.height(), "max-height": 9999}).animate({"height": totalHeight});
        $el.text(jQuery("#ReadMoreJS_Close").val());
        $up.addClass("expanded");
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'useraction',
            'eventCategory': 'general content',
            'eventAction': 'read more open',
            'eventLabel': window.location.href,
            'eventValue': undefined,
            'eventNonInteraction': 0
        });
    } else {
        var _hl = parseInt($p.attr("data-min-height"));
        $up.animate({"height": _hl});
        $el.text(jQuery("#ReadMoreJS_ReadMore").val());
        $up.removeClass("expanded");
    }
    return false;
});