(function ($, Drupal) {
    Drupal.behaviors.nhsc_flavor_selector = {
        attach: function (context, settings) {

            var flavor = jQuery('#edit-flavor').val();

            var selector = '#product-gallery > .field--name-field-product-gallery > .field--item > ';
            var selected = selector + '.owl-carousel';
            var selectev = selector + '.' + flavor;


            if(flavor === ''){
                jQuery(selected).hide();
                jQuery(selected).first().show();
            }


        }
    };

})(jQuery, Drupal);