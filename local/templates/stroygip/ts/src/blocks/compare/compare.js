import {tns} from 'tiny-slider/src/tiny-slider';

let compare = Array.from(document.querySelectorAll('.compare__slider-items'));

if (compare.length > 0) {
    sliderCompare();
}

function sliderCompare() {
    let $slider = document.querySelector('.compare__slider-items');
    let $nav = document.querySelector('.compare__slider-nav');

    let slider;

    slider = tns({
        container: $slider,
        items: 4,
        loop: false,
        gutter: 10,
        speed: 200,
        controls: true,
        controlsContainer: $nav,
        nav: false,
        touch: true,
        mouseDrag: true,
        responsive: {
            1500: {
                items: 5,
            },
        },
        onInit: () => {

        },
    });
}
