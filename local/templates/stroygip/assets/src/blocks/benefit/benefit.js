function initSliderBenefit() {
    let $slider = $('.benefit__carousel');
    let $slidesWrapperDesktop = $slider.find('.buy-item__grid-benefit');
    let $slidesItems = $slider.find('.buy-item');


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

initSliderBenefit();