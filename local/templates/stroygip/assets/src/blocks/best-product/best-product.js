$(".best-product__carousel").owlCarousel({
    dots: false,
    nav: true,
    arrows: true,
    navText : ["",""],
    loop: true,
    center:true,
    autoWidth:true,
    items: 6,
    margin: 16,
    responsive: {
        766: {
            center: true,
            items: 3,
            margin: 10,
        }
    }
});