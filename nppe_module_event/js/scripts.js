

jQuery('h3[data-style]').each(function(){
    var style = jQuery(this).attr('data-style');
    jQuery(this).attr('style', style);
})