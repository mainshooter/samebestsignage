$(function () {
    var alertCount = $('.alert-item').length;
    $('.alert-count').html(alertCount)

    if (alertCount < 1){
        $('.alert-dropdown').remove();
    }
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