import {tns} from 'tiny-slider/src/tiny-slider';

let $header = document.getElementsByClassName('header')[0];
let headerScrollClass = 'header--scroll';

function setScrollClass() {
    if (window.scrollY > 0) {
        $header.classList.add(headerScrollClass);
    } else {
        $header.classList.remove(headerScrollClass);
    }
}

setScrollClass();

window.addEventListener('scroll', () => {
    setScrollClass();
});

const catalogSlider = () => {
    const $slider = document.querySelector('.header__catalog-slider');
    const itemsCount = Array.from($slider.querySelectorAll('.header__catalog-slider-item')).length;
    const $scrollButton = document.querySelector('.header__catalog-slider-button');
    const scrollButtonInvertClass = 'header__catalog-slider-button--invert';
    const $plug = document.querySelector('.header__catalog-slider-wrapper-plug');
    const plugShowClass = 'header__catalog-slider-wrapper-plug--active';

    let slider = tns({
        container: $slider,
        autoWidth: true,
        loop: false,
        mouseDrag: true,
        items: 6,
        gutter: 15,
        swipeAngle: false,
        speed: 400,
        controls: false,
        nav: false,
        onInit: (event) => {
        },
        responsive: {
            1720: {
                gutter: 28,
            }
        }
    });

    slider.events.on('indexChanged', event => {
        if (event.index === 0) {
            $scrollButton.classList.remove(scrollButtonInvertClass);
            $plug.classList.remove(plugShowClass);
        } else {
            $scrollButton.classList.add(scrollButtonInvertClass);
            $plug.classList.add(plugShowClass);
        }
    });

    $scrollButton.addEventListener('click', () => {
        if ($scrollButton.classList.contains(scrollButtonInvertClass)) {
            $scrollButton.classList.remove(scrollButtonInvertClass);
            $plug.classList.remove(plugShowClass);
            slider.goTo(0);
        } else {
            $scrollButton.classList.add(scrollButtonInvertClass);
            $plug.classList.add(plugShowClass);
            slider.goTo(itemsCount - 1);
        }
    });

};

catalogSlider();