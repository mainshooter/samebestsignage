/*
var scrollTimeout = null;
var scrollendDelay = 300; // ms

$(window).scroll(function() {
    if ( scrollTimeout === null ) {
        scrollbeginHandler();
    } else {
        clearTimeout( scrollTimeout );
    }
    scrollTimeout = setTimeout( scrollendHandler, scrollendDelay );
});

function scrollbeginHandler() {
    // this code executes on "scrollbegin"
    $(".pages").css({'position': 'fixed', 'bottom': '0px', 'left': '50%', 'transform': 'translate(-50%)' });
    $( ".pages" ).slideUp();
}

function scrollendHandler() {
    // this code executes on "scrollend"
    $( ".pages" ).slideDown();
    scrollTimeout = null;
}

$(window).scroll(function() {
    if((Math.max(document.documentElement.clientHeight, window.innerHeight || 0) - window.screen.height) == $(window).scrollTop()) {
        $(".pages").css({'position': 'unset', 'bottom': '0px', 'left': 'unset', 'transform': 'unset' });

    }
});
*/
$(function () {
    $(".card-body-color").dotdotdot({
        // Options go here
    });
});