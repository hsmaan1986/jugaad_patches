jQuery(document).ready(function() {
    function convertImgToBase64(url, callback, outputFormat) {
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
        var img = new Image();
        img.crossOrigin = 'Anonymous';
        ctx.webkitImageSmoothingEnabled = true;
        ctx.mozImageSmoothingEnabled = true;
        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = "high";
        img.onload = function() {
            canvas.height = img.height;
            canvas.width = img.width;
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL(outputFormat || 'image/png');
            callback.call(this, dataURL);
            canvas = null;
        };
        img.src = url;
    }
    jQuery(".pdf-image").each(function(index, element) {
        convertImgToBase64(jQuery(this).attr("src"), function(base64Img) {
            jQuery(element).attr('src', base64Img);
        });
    });
    jQuery('.pdf-download-button-results').click(function(event) {
        event.preventDefault();
        jQuery("#pdf-content").attr("hidden", false);
        var element = jQuery('#pdf-content').html();
        var opt = {
            margin: 0.2,
            filename: 'informacion-nutricional-resultados.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().from(element).set(opt).save();
        jQuery("#pdf-content").attr("hidden", true);
    });
    jQuery('#pdf-download-button-results').click(function(event) {
        event.preventDefault();
        jQuery("#pdf-content").attr("hidden", false);
        var element = jQuery('#pdf-content').html();
        var opt = {
            margin: 0.2,
            filename: 'informacion-nutricional-resultados.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().from(element).set(opt).save();
        jQuery("#pdf-content").attr("hidden", true);
    });
});