function animateCheck(elem, href) {
    elem.fadeIn(function () {
        if(href != 0) {
            setTimeout(function () {
                window.location = href;
            }, 2000);
        }
    });
}