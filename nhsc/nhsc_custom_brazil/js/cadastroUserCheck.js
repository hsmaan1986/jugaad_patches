(function ($, Drupal) {
    Drupal.behaviors.cadastroUserCheck = {
        attach: function (context, settings) {

            /* Check if user is registed in Cadastro the compare the CPF values */

            /* Check if user CPF is registed in Cadastro */
            $('input#edit-identification-number', context).on('change', function () {
                var cpf = this.value;

                if (!this.value.length) {
                    cpf = '000.000.000-00';
                }

                var field_list = [
                    "#edit-first-name",
                    "#edit-last-name",
                    "#edit-birth-date-date",
                    "#edit-email",
                    "#edit-password-pass1",
                    "#edit-password-pass2",
                    "#edit-occupation",
                    "#edit-submit"
                ];

                // disable fields


                    var url = '/ajax/cpf-checker/' + cpf;

                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function(){
                            $('input#edit-identification-number').after('<div id="js-spinner-cpf" class="loader-container" style="top:40px !important;"><div class="loader">Loading...</div></div>');
                        },
                        success:function(data){

                            if (data.CPF === cpf) {
                                /* This CPF is already registered */
                                $('input#edit-identification-number').after(data.error_place);
                                enDisFields(field_list, true);
                            }else{
                                // enable fields
                                jQuery('.alert-danger').remove();
                                enDisFields(field_list, false);
                            }

                            $('#js-spinner-cpf').remove();
                        },
                        fail:function () {
                            console.log('CPF not found');
                            $('#js-spinner-cpf').remove();
                        }
                    });

            });

            function enDisFields(fields, disable){

                fields.forEach(function (currentValue, index) {
                    if (disable === true){
                        $(currentValue).attr('disabled', true);
                    }else{
                        $(currentValue).removeAttr('disabled');
                    }

                });
            }
        }
    };
})(jQuery, Drupal);

function validate_email(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}