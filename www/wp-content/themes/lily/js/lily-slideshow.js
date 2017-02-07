jQuery(document).ready(function($) {

    'use strict';
    
    var $headerImages = $('#header-images');
    var headerImage = $headerImages.children();

    // Header slideshow function
    function headerSlideshow() {

        var firstBg = headerImage.first(),
            activeBg = $(".activeBg");

        if ( ! activeBg.length > 0 ) {
            firstBg.addClass("activeBg");
            var activeBg = firstBg;
        }

        var nextBg = activeBg.next();

        if (nextBg.length > 0) {
            activeBg.removeClass("activeBg");
            nextBg.addClass("activeBg").stop(true, true).fadeIn(3000, function() {
                activeBg.hide();
            });
        } else {
            activeBg.removeClass("activeBg");
            firstBg.addClass("activeBg").stop(true, true).fadeIn(3000, function() {
                activeBg.hide();
            });
        }
    };
        
    // Header slideshow fade transition speed
    if ( headerImage.length > 1 ) {
        setInterval(function() {
            headerSlideshow(); 
        }, 
            lily_slideshow_js_vars.slideshow_fade_time * 1000
        );
    }    
});