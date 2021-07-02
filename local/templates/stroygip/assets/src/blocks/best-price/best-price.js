function initSliderBestPrice() {
    let $slider = $('.best-price__carousel');
    let $slidesWrapperDesktop = $slider.find('.best-price__grid');
    let $slidesItems = $slider.find('.best-price__item');


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