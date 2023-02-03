(function ($, Drupal) {
    Drupal.behaviors.nhsc_user_profile_via_user_profile_mobile = {
        attach: function (context, settings) {
            if ($(window).width() < 960) {
                $("#block-tabs .menu--tabs li").each(function () {
                    $(this).find("a").html($(this).find("a").html().split(" ").pop());
                });
            }

            $(window).resize(function() {
                if ($(window).width() < 960) {
                    $("#block-tabs .menu--tabs li").each(function () {
                        $(this).find("a").html($(this).find("a").html().split(" ").pop());
                    });
                }
            });
        }
    };

    /**
     * runs through each field
     * check if it has a place holder
     * if not then get the placeholder from the label
     * checks password
     */
    $('input[type="password"]').each(function(){
        var attr = $(this).attr('placeholder');
        if ($(this).attr('placeholder') == null) {
            var elementId = $(this).attr('id');
            var placeHolderText = $('label[for="'+elementId+'"]').text();
            $(this).attr('placeholder',placeHolderText);
        }
    });

})(jQuery, Drupal);