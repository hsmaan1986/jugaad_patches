(function ($, Drupal) {
    Drupal.behaviors.nhsc_ccg_spend_calculator = {
        hasRan: false,
        attach: function (context, settings) {

            $.fn.openPopup = function (){
                jQuery.fancybox.open([{href: '.ccg-modal', type: 'inline'}], {
                    wrapCSS: 'nhs-ccg-fancybox',
                    padding: '20px',
                    margin: 0,
                    scrolling: 'yes',
                    closeBtn: true,
                    minHeight: 500,
                    modal: false
                });
            };


        }
    };


})(jQuery, Drupal);