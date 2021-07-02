$('.services__carousel').owlCarousel({
    dots: false,
    nav: true,
    arrows: true,
    navText : ["",""],
    loop: false,
    margin: 16,
    singleItem:true,
    items: 4,
    responsive:{
        1279:{
            items:4,
        },
        1023:{
            items:3,
        },
        440:{
            items:2,
        },
        0:{
            items:1,
        }
    }
});

$('.services__tabs').on('click', '.services__tab:not(.active)', function() {
    $(this)
        .addClass('active').siblings().removeClass('active')
        .closest('.services__inner').find('.services__content').removeClass('active').eq($(this).index()).addClass('active');
});