
$(document).ready(function () {

 var _cookieMYS = parseInt(nhs_getCookie("meriteneYoutubeSplash"));
 if (_cookieMYS != "1"){
   nhs_writeCookiePlusOneYear("meriteneYoutubeSplash", "1", "/");

   var wsize=screen.width;
   var hsize=screen.height;

   var wsize = Math.min(screen.width,screen.height);

   if (wsize > 800){wsize=800;}


   var _content = '';

   _content += '<div id="MeriteneYoutubeSplashScreen" style="width:'+wsize+'px;">';
   _content += '<img src="/asset-library/PublishingImages/brands/meritene/meritene-logo.png">';
   _content += '<div class="youtube-outer-wrapper">';
   _content += '<div class="youtube-wrapper"><iframe width="1" height="1" src="//www.youtube.com/embed/WoYPrBPW8u4?autoplay=1&controls=0&rel=0&amp;showinfo=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" frameborder="0"></iframe></div>';
   _content += '</div>';
   _content += '<br><a class="button" href="/marcas/meritene" title="Discover">DESCÚBRELO</a>';
   _content += '</div>';

   $.fancybox.open([{ content: _content }], { wrapCSS: 'nhs-fancybox', padding: 0, margin: 0, scrolling: 'no', closeBtn: true, minHeight: 100, modal: false });
   $(document).on("click", "#MeriteneYoutubeSplashScreen .button", function () {
     $.fancybox.close();
     return false;
   });
 }

});
