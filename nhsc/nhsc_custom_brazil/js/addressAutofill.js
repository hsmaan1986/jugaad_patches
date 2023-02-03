(function ($, Drupal) {
    Drupal.behaviors.addressAutofill = {
        attach: function (context, settings) {

            $('input#edit-field-address-zip-0-value', context).on('input', function () {
                var zip_code = this.value;

                if (validate_zip(zip_code)) {
                    var url = '/ajax/address-search/' + zip_code;
                    var user_details_json = [];

                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function(){
                          $('input#edit-field-address-zip-0-value').after('<div id="js-spinner" class="loader-container"><div class="loader">Loading...</div></div>');
                        },
                        success:function(data){
                            user_details_json = data[0];

                            user_details_json = JSON.stringify(user_details_json);
                            user_details_json = JSON.parse(user_details_json);

                            jQuery('#edit-field-address-street-0-value').val((user_details_json.Logradouro).toTitleCase());
                            jQuery('#edit-field-address-city-0-value').val((user_details_json.Cidade).toTitleCase());
                            jQuery('#edit-field-address-state-0-value').val((user_details_json.Bairro).toTitleCase());
                            jQuery('#edit-field-address-country-0-value').val((user_details_json.Pais).toTitleCase());


                            $('#js-spinner').remove();
                        },
                        fail:function () {
                            console.log('address not found');
                            $('#js-spinner').remove();
                        }
                    })

                }
            });

            $('input#edit-field-institution-address-zip-0-value', context).on('input', function () {
                var zip_code = this.value;

                if (validate_zip(zip_code)) {
                    var url = '/ajax/address-search/' + zip_code;
                    var user_details_json = [];
                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function(){
                          $('input#edit-field-institution-address-zip-0-value').after('<div id="js-spinner" class="loader-container"><div class="loader">Loading...</div></div>');
                        },
                        success:function(data){
                            user_details_json = data[0];
                            user_details_json = JSON.stringify(user_details_json);
                            user_details_json = JSON.parse(user_details_json);
                            jQuery('#edit-field-institution-address-street-0-value').val((user_details_json.Logradouro).toTitleCase());
                            jQuery('#edit-field-institution-address-city-0-value').val((user_details_json.Cidade).toTitleCase());
                            jQuery('#edit-field-institution-address-state-0-value').val((user_details_json.Bairro).toTitleCase());
                            jQuery('#edit-field-institution-country-0-value').val((user_details_json.Pais).toTitleCase());

                            $('#js-spinner').remove();
                        },
                        fail:function () {
                            console.log('address not found');
                            $('#js-spinner').remove();
                        }
                    })
                }
            });

        }
    };
})(jQuery, Drupal);

function validate_zip(zip_code) {
    var check = /[0-9]{5}-?[0-9]{3}$/;
    return check.test(zip_code);
}

// Function to convert string to title case
String.prototype.toTitleCase = function () {
  return this.replace(/\w\S*/g, function(txt){
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}
