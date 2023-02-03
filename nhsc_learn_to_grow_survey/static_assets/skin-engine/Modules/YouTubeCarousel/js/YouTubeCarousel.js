$(document).ready(function() {
    var youtubecarouselcontainer = $('.youtubecarousel-container');
    youtubecarouselcontainer.each(function () {
        var _youtubecarouselcontainer = $(this);
        var maxItems = _youtubecarouselcontainer.find('#hiddenYouTubeCarouselValues #maxItems').val();
        var slideSpeed = Number(_youtubecarouselcontainer.find('#hiddenYouTubeCarouselValues #slideSpeed').val()) * 1000;
        var autoPlayTimeOut = Number(_youtubecarouselcontainer.find('#hiddenYouTubeCarouselValues #autoPlay').val()) * 1000;
        var autoPlay = (autoPlayTimeOut > 0);
        var addDescription = _youtubecarouselcontainer.find('#hiddenYouTubeCarouselValues #addDescription').val() == "True" ? true : false;
        var addThumbnailTitle = _youtubecarouselcontainer.find('#hiddenYouTubeCarouselValues #addThumbnailTitle').val() == "True" ? true : false;

        var owl = _youtubecarouselcontainer.find("#youtubecarousel");
        owl.owlCarousel({
            autoPlay: autoPlay,
            autoplayTimeout: autoPlayTimeOut,
            items: maxItems,
            pagination: true,
            navigation: true,
            slideSpeed: slideSpeed,
            itemsScaleUp: true,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 2],
            itemsMobile: [479, 2]
        });
        if (addDescription && _youtubecarouselcontainer.find(".info-container .description .expand").html().length > 0) {
            _youtubecarouselcontainer.find(".info-container .description").show();
        }
        if (addThumbnailTitle) {
            _youtubecarouselcontainer.find('#youtubecarousel .item .thumbnail_title').show();
        }

        $(this).find('#youtubecarousel .owl-item').on('click', function () {
            var curItem = $(this);
            var carouselContainer = curItem.parents().find('#youtubecarousel').get(0);
            var videoCarouselContainer = curItem.closest(".youtubecarousel-container");
            curItem.parent().find('.item img').css('opacity', '0.6');
            curItem.parent().find('.item').css('color', '#808080');
            curItem.css('color', '#000000');
            curItem.find('img').css('opacity', '1.0');

            
            embendYouTubeVideo(videoCarouselContainer, $(this).find('.item').attr('id'));
        });
    });
    /*Override carousel prev/next button text*/
    $('.owl-buttons div').html('');

    $('#youtubecarousel .item').first().css('color', '#000000');
    $('#youtubecarousel .item img').first().css('opacity', '1');

    $('body').on('click', ".info-container .description .slider", function () {
        var curSlider=$(this);
        $(this).parent().find(".expand").stop(false, true).slideToggle("fast", function () {
            if (curSlider.children('#down').css('display') != 'none') {
                curSlider.children('#down').hide();
                curSlider.children('#up').show();
            } else {
                curSlider.children('#down').show();
                curSlider.children('#up').hide();
            }
        });
    });
});

function embendYouTubeVideo(parentContainer,videoId) {
    var autoPlayYoutubeVideo = parentContainer.find('#hiddenYouTubeCarouselValues #autoPlayVideo').val();
    var addDescription = parentContainer.find('#hiddenYouTubeCarouselValues #addDescription').val() == "True" ? true : false;

    parentContainer.find('#youtubevideo iframe').attr('src', 'https://www.youtube.com/embed/' + videoId + '?rel=0&autoplay=' + autoPlayYoutubeVideo);
    parentContainer.find('#youtubevideo iframe').attr('id', videoId);
    var _titleSelector = '#youtubecarousel #' + videoId + ' #title_' + videoId;
    parentContainer.find('.info-container .title').html(parentContainer.find(_titleSelector).html());
    parentContainer.find('.info-container .description').hide();
    var _descHtml = parentContainer.find('#youtubecarousel #' + videoId + ' #descr_' + videoId).html();
    parentContainer.find('.info-container .description .expand').html(_descHtml);
    if (addDescription && parentContainer.find('.info-container .description .expand').html().length > 0) {
        parentContainer.find('.info-container .description').show();
    }
}