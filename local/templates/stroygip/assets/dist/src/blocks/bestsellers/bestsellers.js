function initSliderBestPrice() {
    let $slider = $('.bestsellers__carousel');
    let $slidesWrapperDesktop = $('.best-price__grid-bestprice');
    let $slidesItems = $('.best-price__grid-bestprice').find('.buy-item');


    let sliderOptions = {
        dots: false,
        nav: true,
        arrows: true,
        navText: ["", ""],
        loop: true,
        singleItem: true,
        items: 1
    };

    if (viewportWidth < mobileWidthSmall) {
        $slidesItems.detach().appendTo($slider);
        $slidesWrapperDesktop.remove();
        $slider.owlCarousel(sliderOptions);
    } else {
        $slider.owlCarousel(sliderOptions);
    }
}

initSliderBestPrice();