import {tns} from 'tiny-slider/src/tiny-slider';

const partnersSlider = () => {
    const $wrapper = document.querySelector('.partners');
    const $slider = $wrapper.querySelector('.partners__slider');
    const $nav = $wrapper.querySelector('.partners__nav');

    let slider = tns({
        container: $slider,
        autoWidth: false,
        loop: true,
        mouseDrag: true,
        items: 3,
        gutter: 5,
        swipeAngle: false,
        speed: 400,
        controls: false,
        controlsContainer:$nav,
        nav: false,
        responsive: {
            1000: {
                items: 5,
                gutter: 16,
            },
            1320: {
                controls: true,
            },
            1720: {
                items: 7,
            },

        },
        onInit: (event) => {

        },
    });

};

if (Array.from(document.querySelectorAll('.partners')).length > 0) {
    partnersSlider();
}