function animateCheck(elem, href) {
    elem.fadeIn(function () {
        setTimeout(function(){
            window.location = href;
        }, 2000);
    });

    /*
    var maxPopoutHeight = ((height / 100) * 110);
    var maxPopoutWidth = ((height / 100) * 110);

    var maxPopinHeight = ((height / 100) * 85);
    var maxPopinWidth = ((height / 100) * 85);

    elem.css({'opacity': 0, 'height': 0, 'width': 0});
    elem.show();

    elem.animate({
        opacity: 1,
        height: String(maxPopoutHeight + type),
        width: String(maxPopoutWidth + type)
    }, 800, function() {
        elem.animate({
            opacity: 0.8,
            height: String(maxPopinHeight + type),
            width: String(maxPopinWidth + type)
        }, 600, function() {
            elem.animate({
                opacity: 1,
                height: String(height + type),
                width: String(width + type)
            }, 500, function() {
                elem.animate({
                    opacity: 0,
                    height: "0px",
                    width: '0px'
                }, 1000, function() {
                    window.location = href;
                });
            });
        });
    });
    */
}