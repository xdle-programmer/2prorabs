$('.news__tabs').on('click', '.news__tab:not(.news__tab--active)', function() {
    $(this)
        .addClass('news__tab--active').siblings().removeClass('news__tab--active')
        .closest('.news__inner').find('.news__content').removeClass('news__content--active').eq($(this).index()).addClass('news__content--active');
});


var sync1 = $('#owl-slider'),
    sync2 = $('#owl-carousel'),
    duration = 300,
    thumbs = 3;

// Sync nav
sync1.on('click', '.owl-next', function () {
    sync2.trigger('next.owl.carousel')
});
sync1.on('click', '.owl-prev', function () {
    sync2.trigger('prev.owl.carousel')
});

// Start Carousel
sync1.owlCarousel({
    // rtl: true,
    center : true,
    loop: true,
    items : 1,
    margin:0,
    nav : true
})
    .on('dragged.owl.carousel', function (e) {
        if (e.relatedTarget.state.direction == 'left') {
            sync2.trigger('next.owl.carousel')
        } else {
            sync2.trigger('prev.owl.carousel')
        }
    });


sync2.owlCarousel({
    // rtl: true,
    center: true,
    loop: true,
    items : thumbs,
    margin:16,
    arrows: false,
    nav : false,
})
    .on('click', '.owl-item', function() {
        var i = $(this).index()-(thumbs+1);
        sync2.trigger('to.owl.carousel', [i, duration, true]);
        sync1.trigger('to.owl.carousel', [i, duration, true]);
    });