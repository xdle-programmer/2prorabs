import {tns} from 'tiny-slider/src/tiny-slider';
import GLightbox from 'glightbox';

let counters = Array.from(document.querySelectorAll('.product-page__counter'));

if (counters.length > 0) {
    for (let $counter of counters) {
        counterHandler($counter);
    }
}

function counterHandler($counter) {
    let $minus = $counter.querySelector('.product-page__counter-button--minus');
    let $plus = $counter.querySelector('.product-page__counter-button--plus');
    let $value = $counter.querySelector('.product-page__counter-value');
    let $amount = $counter.closest('.product-page__price-block-count').querySelector('.product-page__price-block-count-price-number');
    let max = +$counter.dataset.counterMax;
    let price = +$counter.dataset.price;

    $minus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value <= 1) {
            value = 1;
        } else {
            value -= 1;
        }

        $value.innerText = value;
        setPrice(value);
    });

    $plus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value >= max) {
            value = max;
        } else {
            value += 1;
        }

        $value.innerText = value;
        setPrice(value);
    });

    function setPrice(value) {
        $amount.innerText = numberWithSpaces(value * price);
    }

    function numberWithSpaces(x) {
        let parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        return parts.join(".");
    }
}

let sliderWrapper = Array.from(document.querySelectorAll('.product-page__slider-wrapper'));

if (sliderWrapper.length > 0) {
    sliderInit(sliderWrapper[0]);
}

function sliderInit($wrapper) {

    const $slider = $wrapper.querySelector('.product-page__slider-items');
    const $nav = $wrapper.querySelector('.product-page__slider-nav');

    let slider = tns({
        container: $slider,
        autoWidth: false,
        loop: true,
        mouseDrag: false,
        axis: 'vertical',
        items: 4,
        gutter: 10,
        swipeAngle: false,
        speed: 400,
        controls: true,
        controlsContainer: $nav,
        nav: false,
        responsive: {
            0: {
                items: 4,
                gutter: 5,
            },
            1320: {
                mouseDrag: true,
                gutter: 10,
                items: 6,
            },
        },
        onInit: () => {
            initChangePreview();
        },
    });

    function initChangePreview() {
        let items = $wrapper.querySelectorAll('.product-page__slider-item');
        let $mainPreview = document.querySelector('.product-page__main-image');
        let itemActiveClass = 'product-page__slider-item--active';

        for (let $item of items) {
            $item.addEventListener('click', event => {
                let $elem;

                if (event.target.classList.contains('product-page__slider-item')) {
                    $elem = event.target;
                } else {
                    $elem = event.target.closest('.product-page__slider-item');
                }

                let src = $elem.dataset.preview;
                let target = $elem.dataset.activeNumberTarget;
                $mainPreview.src = src;
                $mainPreview.dataset.activeNumber = target;


                for (let $item of document.querySelectorAll('[data-active-number-target]')) {
                    $item.classList.remove(itemActiveClass);

                    for (let $activeItem of document.querySelectorAll('[data-active-number-target="' + target + '"]')) {
                        $activeItem.classList.add(itemActiveClass);
                    }
                }
            });
        }
    }

}


let previewImage = Array.from(document.querySelectorAll('.product-page__main-image'));

if (previewImage.length > 0) {
    initLightbox(previewImage[0]);
}

function initLightbox($img) {

    let elements = $img.dataset.imagesArray.split(',').map(url => {
        return {
            'href': url,
            'type': 'image',
        };
    });

    const lightbox = GLightbox({
        elements: elements,
        touchNavigation: true,
        loop: true,
    });

    $img.addEventListener('click', () => {
        lightbox.openAt(+$img.dataset.activeNumber);
    });
}


let reviewsHiddenForms = Array.from(document.querySelectorAll('.product-page__desc-reviews-hidden-form-wrapper'));

if (reviewsHiddenForms.length > 0) {
    for (let $reviewsHiddenForm of reviewsHiddenForms) {
        reviewsHiddenFormsHandler($reviewsHiddenForm);
    }
}

function reviewsHiddenFormsHandler($wrapper) {
    let $button = $wrapper.querySelector('.product-page__desc-reviews-hidden-form-button');
    let $form = $wrapper.querySelector('.product-page__desc-reviews-hidden-form');

    $button.addEventListener('click', () => {
        $button.style.display = 'none';
        $form.style.display = 'block';
    });
}