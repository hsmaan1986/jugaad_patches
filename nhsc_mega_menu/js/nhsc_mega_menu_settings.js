
(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.nhscMegaMebuSettingsBehavior = {
    attach: function (context, settings) {

      if (context !== document) {
        return;
      }

      window.runOnce = false;

      if (!window.runOnce) {
        var $menuPosition = (drupalSettings.menuPosition) ? drupalSettings.menuPosition : 1;

        $('.menu-position-order').insertAfter('ul#cd-primary-nav:first > li:nth-child(' + $menuPosition + ')');

        window.runOnce = true;
      }
    }
  };

})(jQuery, Drupal, drupalSettings );
