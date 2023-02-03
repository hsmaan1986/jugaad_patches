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
    Drupal.behaviors.kwitConnector = {
        attach: function () {

            var kwitButtons = drupalSettings.nhsc_kwit;

            Object.keys(kwitButtons).forEach(function(htmlId) {
                var kwitId = kwitButtons[htmlId];

                var callToAction = document.getElementById(htmlId);
                window.addEventListener('DOMContentLoaded', function(){
                    callToAction.addEventListener("click", function() {
                        KwitBrandWidget.showProduct(kwitId);
                    });
                });
            });

        }
    };
})(jQuery, Drupal, drupalSettings);
