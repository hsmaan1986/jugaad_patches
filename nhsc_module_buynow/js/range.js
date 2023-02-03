/**
 @author: Wunderman South Africa
 @author-list:Emil van der Lingen
 **/

(function ($, Drupal) {
    Drupal.behaviors.nhsc_module_buybow = {
        attach: function(context, settings) {
            var default_version = 1;

            // get general settings
            var buynow_settings     = jQuery('#nhsc-buynow-general-settings');
            var buynow_brand        = jQuery(buynow_settings).attr('data-brand');
            var buynow_unit         = jQuery(buynow_settings).attr('data-unit');
            var buynow_environment  = jQuery(buynow_settings).attr('data-environment');
            var buynow_country      = jQuery(buynow_settings).attr('data-country');
            var buynow_language     = jQuery(buynow_settings).attr('data-language');
            var buynow_showprice    = jQuery(buynow_settings).attr('data-showprice');
            var buynow_version      = jQuery(buynow_settings).attr('data-version');
            // set a default version if not assigned
            if(buynow_version == '') var buynow_version = default_version;

            // style settings
            var buynow_style               = jQuery('#nhsc-buynow-style-settings');
            var style_background           = jQuery(buynow_style).attr('data-background');
            var style_background_op        = jQuery(buynow_style).attr('data-background-opacity');
            var style_background_img       = jQuery(buynow_style).attr('data-background-image');
            var style_background_img_op    = jQuery(buynow_style).attr('data-background-image-opacity');
            var style_border_width         = jQuery(buynow_style).attr('data-border-width');
            var style_border_radius        = jQuery(buynow_style).attr('data-border-radius');
            var style_product_img_pos      = jQuery(buynow_style).attr('data-product-image-position');
            var style_font_family          = jQuery(buynow_style).attr('data-font-family');
            var style_font_size            = jQuery(buynow_style).attr('data-font-size');
            var style_cta_color            = jQuery(buynow_style).attr('data-cta-color');
            var style_cta_font_color       = jQuery(buynow_style).attr('data-cta-font-color');
            var style_cta_hover_color      = jQuery(buynow_style).attr('data-cta-color-hover');
            var style_cta_font_hover_color = jQuery(buynow_style).attr('data-cta-font-color-hover');

            // click and collect settings
            var buynow_cac                 = jQuery("#nhsc-buynow-cac-settings");
            var cac_geolocate = jQuery(buynow_cac).attr('data-cac-geolocate');
            var cac_autocomplete = jQuery(buynow_cac).attr('data-cac-autocomplete');
            var cac_store        = jQuery(buynow_cac).attr('data-cac-storelocation');
            var cac_map          = jQuery(buynow_cac).attr('data-cac-map');
            var cac_dualtbl      = jQuery(buynow_cac).attr('data-cac-dualtbl');
            var cac_filter       = jQuery(buynow_cac).attr('data-cac-filter');

            // range settings
            var buynow_range = jQuery("#nhsc-buynow-range-settings");
            var range_status  = jQuery(buynow_range).attr('data-range-status');
            var range_label = jQuery(buynow_range).attr('data-range-label');
            var range_id = jQuery(buynow_range).attr('data-range-id');
            var range_class = jQuery(buynow_range).attr('data-range-btn-class');
            var range_button_id = jQuery(buynow_range).attr('data-range-btn-id');
            var range_ext_url = jQuery(buynow_range).attr('data-range-ext-url');

            // product settings
            var buynow_product = jQuery("#nhsc-buynow-product-settings");
            var product_status = jQuery(buynow_product).attr('data-product-status');
            var product_label  = jQuery(buynow_product).attr('data-product-btn-label');
            var product_btn_class  = jQuery(buynow_product).attr('data-product-btn-class');
            var product_ext_url = jQuery(buynow_product).attr('data-product-ext-url');

            /**
             Product Button Stuffies
             **/
            if(product_status != '1'){
                jQuery('.product-buy-now-button-container').remove();
            }else{
                if(product_label != ''){
                    jQuery('.product-buy-now-button-container a').html(product_label);
                }

                if(product_btn_class != ''){
                    jQuery('.product-buy-now-button-container a').addClass(product_btn_class);
                }

                if(product_ext_url != ''){
                    jQuery('.product-buy-now-button-container a').attr('target','_blank');
                    jQuery('.product-buy-now-button-container a').removeClass('nhsc-module-buynow-product-button');
                    jQuery('.product-buy-now-button-container a').attr("href",product_ext_url);
                }

                jQuery('.product-buy-now-button-container').fadeIn("slow");
            }

            /** Settings
             - check if settings set
             **/

            var buynowSettings = {}
            if(buynow_brand != '') buynowSettings.brand = buynow_brand;
            if(buynow_unit != '') buynowSettings.unit = buynow_unit;
            if(buynow_environment != '') buynowSettings.environment = buynow_environment;
            if(buynow_country != '') buynowSettings.country = buynow_country;
            if(buynow_language != '') buynowSettings.language = buynow_language;
            if(buynow_showprice != '') buynowSettings.showprice = buynow_showprice;

            /** Style
             - check if style is set and assign to object if set else leave as is
             **/
            var buynowStyles = {}
            if(style_background != '') buynowStyles.backgroundColor = style_background;
            if(style_background_op != '') buynowStyles.backgroundOpacity = style_background_op;
            if(style_background_img != '') buynowStyles.backgroundImage = style_background_img;
            if(style_background_img_op != '') buynowStyles.backgroundImageOpacity = style_background_img_op;
            if(style_border_width != '') buynowStyles.borderWidth = style_border_width;
            if(style_border_radius != '') buynowStyles.borderRadius = style_border_radius;
            if(style_product_img_pos != '') buynowStyles.productImagePosition = style_product_img_pos;
            if(style_font_family != '') buynowStyles.fontFamily = style_font_family;
            if(style_font_size != '') buynowStyles.productFontSize = style_font_size;
            if(style_cta_color != '') buynowStyles.ctaColor = style_cta_color;
            if(style_cta_font_color != '') buynowStyles.ctaFontColor = style_cta_font_color;
            if(style_cta_hover_color != '') buynowStyles.ctaHoverColor = style_cta_hover_color;
            if(style_cta_font_hover_color != '') buynowStyles.ctaHoverFontColor = style_cta_font_hover_color;


                    



            if(buynow_version == 1) {
                 jQuery('.nhsc-module-buynow-product-button').click(function(event){

                      // get the product id
                    var productId = jQuery(this).attr('data-fusepumpid');

                    // run buy now version 1
                    if(buynow_version == 1){
                        // build lightbox object
                        var lightbox = new fusepump.lightbox.buynow(productId, {
                            // add settings

                            // add styles
                            style: buynowStyles



                        });
                        // call lightbox
                        lightbox.show();
                    }

                    event.stopImmediatePropagation();
            });
            }else if(buynow_version == 2){
                // click action for individual product
                jQuery('.nhsc-module-buynow-product-button').each(function(){
                    var fpId = jQuery(this).data('fusepumpid');
                    var btnId = 'id-'+fpId;
                    var placeholder = 'fusepump-lightbox-';


                    //add the id attribute on the button


                    jQuery(this).attr('id', btnId);
                    jQuery(this).click(function(e) {
                       e.preventDefault();
                        jQuery("body").append(jQuery("<div id='" + placeholder+btnId + "' />"));
                        var buynow = new fusepump.extend.clickAndCollect.Lightbox({
                            sku: String(fpId),
                            brand: buynow_brand,
                            unit: buynow_unit,
                            buttonId: btnId,
                            environment: buynow_environment,
                            country: buynow_country,
                            language: buynow_language,
                            style: buynowStyles,
                            id: placeholder + btnId,
                            showPrice: buynow_showprice === "TRUE",
                            autoopen: "TRUE",

                            clickAndCollect: {
                                geolocate: cac_geolocate  === "TRUE", // enable geolocation option
                                autocomplete: cac_autocomplete  === "TRUE",// enable Google Place Autocomplete. If disabled postcode option will take its place
                                storeLocation: cac_store  === "TRUE",// Include location of store next to store logo
                                mapView: cac_map  === "TRUE",// Open the lightbox in map view by default
                                dualTable: cac_dualtbl  === "TRUE", // Display Drive and Delivery tables simultaneously

                                filters: {
                                    size: 'checkbox'// Sets style of size filter, can be set to 'checkbox'or 'select'
                                }

                            }

                        });
                    })


				});
			}




            // version one
            if(buynow_version == 1){
                // click action for range button
                var lightbox = new fusepump.lightbox.buynow(range_id, {
                        // add styles
                        style: buynowStyles
                    });
                jQuery('.nhsc-module-buynow-range-button').click(function(event){


                    // show lightbox
                    lightbox.show();

                    event.stopImmediatePropagation();
                });

            }else if(buynow_version == 2){
                // click action for range product
                jQuery('.nhsc-module-buynow-range-button').each(function(){
                    var rangetn = 'id-'+range_id;
                    var placeholder = 'fusepump-lightbox-';
                    //add the id attribute on the button
                    jQuery(this).attr('id', rangetn);

                    jQuery("body").append(jQuery("<div id='" + placeholder+ range_id + "' />"));


                    new fusepump.extend.clickAndCollect.Lightbox({
                        rangeId: range_id,
                        brand: buynow_brand,
                        unit: 'range',
                        buttonId: rangetn,
                        environment: buynow_environment,
                        country: buynow_country,
                        language: buynow_language,
                        style: buynowStyles,
						id: placeholder + range_id,
                        showPrice: buynow_showprice  === "TRUE",

                        clickAndCollect: {
                            geolocate: cac_geolocate  === "TRUE", // enable geolocation option
                            autocomplete: cac_autocomplete  === "TRUE",// enable Google Place Autocomplete. If disabled postcode option will take its place
                            storeLocation: cac_store  === "TRUE",// Include location of store next to store logo
                            mapView: cac_map  === "TRUE",// Open the lightbox in map view by default
                            dualTable: cac_dualtbl  === "TRUE", // Display Drive and Delivery tables simultaneously

                            filters: {
                                size: 'checkbox'// Sets style of size filter, can be set to 'checkbox'or 'select'
                            }

                        }

                    });

                });
			}


        }
    }
}(jQuery, Drupal));



