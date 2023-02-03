    Drupal.behaviors.bazaarvoice = {
        attach: function (context, settings) {
            
            if(context.nodeName == "#document") 
            {
                if(check_ratings_defined()) {
                    $BV.ui('rr', 'inline_ratings', {
                        productIds: settings.bazaarvoice.ratings.productIds,
                        containerPrefix: 'BVRRInlineRating'
                    });
                }

                if (check_ratings_defined()) {
                    $BV.ui('rr', 'inline_ratings', {
                        productIds: settings.bazaarvoice.ratings.productIds,
                        containerPrefix: 'BVRRInlineRatingMobile'
                    });
                }

                if (typeof settings.bazaarvoice !== 'undefined' && typeof settings.bazaarvoice.review !== 'undefined' && typeof $BV !== 'undefined') {
                    $BV.ui('rr', 'show_reviews', {
                        productId: settings.bazaarvoice.review.productId
                    });
                }
            }
            else
            {
                var lock = 0;
                
                jQuery(document).ajaxStop(function() {
                    if(check_ratings_defined() && jQuery(".details-description").length == 0 && jQuery("#BVRRSummaryContainer").length == 0 && lock < 1)
                    {
                        lock += 1;
                        var ajax_productIds = [];
                        
                        jQuery.each(jQuery("[id^='BVRRInlineRating-']"), function()
                        {
                            if(jQuery(this).html() == "")
                            {
                                var product_id = jQuery(this).attr('id').substr(17);
                                ajax_productIds.push(product_id);
                            }
                        });
                        
                        jQuery.each(jQuery("[id^='BVRRInlineRatingMobile-']"), function()
                        {
                            if(jQuery(this).html() == "")
                            {
                                var product_id = jQuery(this).attr('id').substr(23);
                                ajax_productIds.push(product_id);
                            }
                        });
                        
                        setTimeout(function() {
                            if(jQuery("[id^='BVRRInlineRating-']").length > 0)
                            {
                                $BV.ui('rr', 'inline_ratings', {
                                    productIds: ajax_productIds,
                                    containerPrefix: 'BVRRInlineRating'
                                });
                            }
                            
                            if(jQuery("[id^='BVRRInlineRatingMobile-']").length > 0)
                            {
                                $BV.ui('rr', 'inline_ratings', {
                                    productIds: ajax_productIds,
                                    containerPrefix: 'BVRRInlineRatingMobile'
                                });
                            }
                        }, 2000);
                    }
                });
            }
            
            function check_ratings_defined()
            {
                if(typeof settings.bazaarvoice !== 'undefined' && typeof settings.bazaarvoice.ratings !== 'undefined' && typeof $BV !== 'undefined')
                {
                    return true;
                }
                
                return false;
            }
        }
    };