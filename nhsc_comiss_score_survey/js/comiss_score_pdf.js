(function ($, Drupal) {
    Drupal.behaviors.nhsc_comiss_score_pdf = {
        hasRan: false,
        attach: function (context, settings) {
            var pdfFromHTML = function(selector) {

                var opt = {
                    margin:       0,
                    filename:     'comiss-score-form.pdf',
                    html2canvas:  { dpi: 192, letterRendering: false,},
                    jsPDF:        { unit: 'in', format: 'a4', orientation: 'landscape', title: 'Comiss Score'}
                };

                var element = $('body').get(0);

                // html2pdf().set(opt).from(element).save();
                html2pdf().from(element).toPdf().output('bloburl', {title: "This is my title"}).then(function (pdfAsString) {
                    // The PDF has been converted to a Data URI string and passed to this function.
                    // Use pdfAsString however you like (send as email, etc)! For instance:
                    window.location.replace(pdfAsString);
                });


            };

            window.addEventListener('DOMContentLoaded', function(){
                pdfFromHTML('#PDFContainer');
            });
        }
    };


})(jQuery, Drupal);