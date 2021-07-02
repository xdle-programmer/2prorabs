import {tns} from 'tiny-slider/src/tiny-slider';

export function initNaturalBannerSlider() {
    const naturalBannerSliders = Array.from(document.querySelectorAll('.natural-banner'));

    if (naturalBannerSliders.length > 0) {
        for (let $naturalBannerSlider of naturalBannerSliders) {
            createNaturalBannerSlider($naturalBannerSlider);
        }
    }

    function createNaturalBannerSlider($wrapper) {
        const $slider = $wrapper.querySelector('.natural-banner__wrapper');
        const $nav = $wrapper.querySelector('.natural-banner__nav');

        const slider = tns({
            container: $slider,
            autoWidth: false,
            loop: false,
            mouseDrag: true,
            items: 1,
            gutter: 20,
            swipeAngle: false,
            speed: 400,
            controls: false,
            controlsContainer: $nav,
            nav: false,
            responsive: {
                300: {
                    mouseDrag: false,
                    touch: false,
                    controls: true,
                },
                620: {
                    touch: true,
                    mouseDrag: true,
                    controls: false,
                },
                1320: {
                    controls: true,
                },
            },
            onInit: () => {
            },
        });
    }
}