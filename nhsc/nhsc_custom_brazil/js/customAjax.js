(function ($, Drupal) {
    Drupal.behaviors.customAjax = {
        attach: function (context, settings) {


            $('select#edit-occupation', context).on('change', function () {
                var occupation = this.value;

                console.log('occupation: ', occupation);
                var another_specialty = '';
                var selector = '#another-specialty-wrapper';

                if (occupation === 'hcp15'){
                    another_specialty = '<div class="form-item js-form-item form-type-textfield js-form-type-textfield form-item-another-specialty js-form-item-another-specialty form-group">';
                    another_specialty += '  <label for="edit-another-specialty--KQgz7H13IsE" class="control-label js-form-required form-required">Other Specialty</label>';
                    another_specialty += '  <input data-drupal-selector="edit-another-specialty" class="form-text required form-control" type="text" id="edit-another-specialty--KQgz7H13IsE" name="another_specialty" value="" size="60" maxlength="128" required="required" aria-required="true">';
                    another_specialty += '</div>';
                }

                $(selector).html(another_specialty);
            });

        }
};
})(jQuery, Drupal);
