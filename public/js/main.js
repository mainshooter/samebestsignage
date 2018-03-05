$(function () {
    var alertCount = $('.alert-item').length;
    $('.alert-count').html(alertCount);
});

function LazyMode() {
    $('loader').toggle();
    $('.check').toggle();
}

$(document).on('mousemove', function(e){
    $('.demo').css({
        left:  e.pageX,
        top:   e.pageY
    });
});

window.addEventListener('load', function(){
    var allimages= document.getElementsByTagName('img');
    for (var i=0; i<allimages.length; i++) {
        if (allimages[i].getAttribute('data-src')) {
            allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
        }
    }
}, false);