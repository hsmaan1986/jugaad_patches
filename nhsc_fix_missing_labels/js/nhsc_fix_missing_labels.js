
(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.nhscFixMissingLabelsBehavior = {
    attach: function (context, settings) {

      $(function() {
        $("[placeholder]").each(function() {
          var ph = this.placeholder;

          $(this).removeAttr("placeholder");
          $(this).wrap("<label class=" + ph + "-label>" + ph + ":</label>");

        });
      });

    }
  };

})(jQuery, Drupal, drupalSettings );
