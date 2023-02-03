(function ($, Drupal) {

    function storeSearchPush(action, label){
        dataLayer.push({
            'event': 'customEvent',
            'eventCategory': 'store locator',
            'eventAction': action,
            'eventLabel': label
        });
    };

    jQuery( document ).ready(function() {

        var searchParams = new URLSearchParams(window.location.search)
        var param = searchParams.get('combine');
        var action = 'store locator search ' + param;
        var label = window.location.href;

        if (param !== null) {
            storeSearchPush(action, label);
        }


        $('.office-filter-button').on('click', function () {

            var country = jQuery('option[value="' +  jQuery('[data-drupal-selector="edit-continent"]').val() + '"]').text();
            var continent = jQuery('option[value="' + jQuery('[data-drupal-selector="edit-country"]').val() + '"]').text();

            storeSearchPush(country, continent);

        });


    });



})(jQuery, Drupal);
