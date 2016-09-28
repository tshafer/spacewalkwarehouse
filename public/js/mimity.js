$.fn.exist = function () {
    return $(this).length > 0;
}
function get_width() {
    return $(window).width();
}
$(function () {
    $('ul.nav li.nav-dropdown').hover(function () {
        if (get_width() >= 768) {
            $(this).addClass('open');
        }
    }, function () {
        if (get_width() >= 768) {
            $(this).removeClass('open');
        }
    });
    $('.have-sub .panel-title').append('<i class="fa fa-caret-right"></i>');
    $('.have-sub a').on('click', function () {
        $('.have-sub .panel-title a').not(this).next('i').removeClass('fa-caret-down');
        $('.have-sub .panel-title a').not(this).next('i').addClass('fa-caret-right');
        $(this).next('i').toggleClass('fa-caret-right fa-caret-down');
    });

    if ($('.bxslider').exist()) {
        $('.bxslider').bxSlider({
            auto: true,
            pause: 4000,
            pager: false
        });
    }

    $('#imageGallery').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        controls: true,
        thumbItem: 8,
        slideMargin: 0,
        enableDrag: true,
        adaptiveHeight: true,
        currentPagerPosition: 'left',
        onSliderLoad: function (el) {
            $('#imageGallery').removeClass('cS-hidden');
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }
    });

});