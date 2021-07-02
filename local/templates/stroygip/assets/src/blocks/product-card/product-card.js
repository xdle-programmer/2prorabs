$(document).ready(function () {
    /*$('#minusSum').click(function () {
        let $input = $('#calculatorSum');
        let count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });

    $('#plusSum').click(function () {
        let $input = $('#calculatorSum');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });*/
})


var sync1 = $(''),
    sync2 = $('.owl-carousel-vertical'),
    duration = 300,
    thumbs = 4;

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
    center: true,
    loop: true,
    items: 1,
    margin: 0,
    nav: true
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
    // center: true,
    // loop: true,
    // items: thumbs,
    // margin: 16,
    // arrows: false,
    // nav: false,
    items: 4,
    loop: false,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    rewind: true,
    autoplay: true,
    margin: 0,
    nav: true
})
    .on('click', '.owl-item', function () {
        var i = $(this).index() - (thumbs + 1);
        sync2.trigger('to.owl.carousel', [i, duration, true]);
        sync1.trigger('to.owl.carousel', [i, duration, true]);
    });
