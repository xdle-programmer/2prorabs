import {tns} from 'tiny-slider/src/tiny-slider';

export function initPreviewsSlider() {
    const previewsSliders = Array.from(document.querySelectorAll('.previews-slider'));

    if (previewsSliders.length > 0) {
        for (let $previewsSlider of previewsSliders) {
            createPreviewsSlider($previewsSlider);
        }
    }

    function createPreviewsSlider($wrapper) {
        const $slider = $wrapper.querySelector('.previews-slider__wrapper');
        const $nav = $wrapper.querySelector('.previews-slider__nav');

        console.log($wrapper);

        const slider = tns({
            container: $slider,
            autoWidth: false,
            loop: false,
            mouseDrag: true,
            items: 4,
            gutter: 20,
            swipeAngle: false,
            speed: 400,
            controls: false,
            controlsContainer: $nav,
            nav: false,
            responsive: {
                300: {
                    items: 1,
                    mouseDrag: false,
                    touch: false,
                    controls: true,
                },
                620: {
                    items: 2,
                    touch: true,
                    mouseDrag: true,
                    controls: false,
                },
                880: {
                    items: 3,
                },
                1320: {
                    items: 4,
                    controls: true,
                },
            },


            onInit: () => {
            },
        });
    }
}

let initialSliders = Array.from(document.querySelectorAll('.previews-slider--self-initial'));

if (initialSliders.length > 0) {
    initPreviewsSlider();
}