$('.read-blogs__carousel').owlCarousel({
    dots: false,
    nav: true,
    arrows: true,
    navText : ["",""],
    loop: false,
    margin: 16,
    singleItem:true,
    items: 4,
    responsive:{
        1360:{
            items:4,
        },
        1050:{
            items:3,
        },
        768:{
            items:2,
        },
        0:{
            items:1,
            margin: 0,
        },
    }
});