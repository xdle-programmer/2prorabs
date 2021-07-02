$('.recommends-owl-carousel').owlCarousel({
    dots: false,
    nav: true,
    arrows: true,
    navText : ["",""],
    loop: false,
    singleItem:true,
    items: 5,
    margin: 10,
    responsive:{
        0:{
            items:1
        },
        767:{
            items:2
        },
        1023: {
            items: 3,
        },
        1279:{
            items:4
        },
        1401:{
            items:5
        }
    }
});