/**
 * @file
 * TODO: Document.
 */

(function ($, Drupal, drupalSettings) {
    'use strict';

    /**
     *
     * Attaches the JS test behavior to weight div.
     */
    Drupal.behaviors.nhsc_sticky_buttons = {
        attach: function () {

            // jQuery('.fusepumpbutton').on('click', function(){
            //
            //     var btn_id      = jQuery(this)[0].id;
            //     console.log('btn_id', btn_id);
            //     var btns        = drupalSettings.ln_fusepump;
            //     console.log('btns', btns);
            //     var lightbox    = new fusepump.lightbox.buynow(btns [btn_id]);
            //
            //     lightbox.show();
            // });

        }
    };
})(jQuery, Drupal, drupalSettings);
