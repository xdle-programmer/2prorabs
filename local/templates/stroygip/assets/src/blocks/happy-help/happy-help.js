$(document).ready(function(){
    $(".happy-help__carousel").owlCarousel({
        dots: false,
        nav: true,
        arrows: true,
        navText : ["",""],
        loop: true,
        singleItem:true,
        items: 4,
        margin: 64,
        responsive: {
            1276: {
                margin: 64,
            },
            1023: {
                items: 3,
            },
            767: {
                items: 2,
            },
            300: {
                margin: 30,
                items: 1,
            }
        }
    });
});