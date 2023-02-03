Drupal.behaviors.customDatepicker = {
    attach: function (context, settings) {
        jQuery(function () {
            jQuery("#edit-birth-date-date").datepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+18",
                altField: "input[data-drupal-selector=edit-birth-date]",
                altFormat: "yy/mm/dd",
                ignoreReadonly: true,
                minDate: new Date(1900,1-1,1), maxDate: '-18Y',
                beforeShow: function(){
                    jQuery(".ui-datepicker").css('width', '100%')
                }

            });

            jQuery("#edit-field-birth-date-0-value-date").datepicker({
                dateFormat: "dd/mm/yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+18",
                altField: "input[data-drupal-selector=edit-birth-date]",
                altFormat: "yy/mm/dd",
                ignoreReadonly: true,
                minDate: new Date(1900,1-1,1), maxDate: '-18Y',
                beforeShow: function(){
                    jQuery(".ui-datepicker").css('width', '100%')
                }

            });

            // translate calenda
            jQuery.datepicker.regional['br'] = {
                closeText: 'Close',
                prevText: 'Anterior',
                nextText: 'Próximo',
                currentText: 'Current',
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                    'Outubro', 'Novembro', 'Dezembro'
                ],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
                weekHeader: 'Sem',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            jQuery.datepicker.setDefaults(jQuery.datepicker.regional['br']);
        });
    }
};