(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.nhscFindAndReplaceBehavior = {
    attach: function (context, settings) {

      /* Assuming the scaped images are in field type text long */
      $('.field--type-text-long').each(function() {
        $(this).find('img').addClass('scrape-img-responsive');
      });

    }
  };

})(jQuery, Drupal, drupalSettings );
