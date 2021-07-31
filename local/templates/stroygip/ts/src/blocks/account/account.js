import {tns} from 'tiny-slider/src/tiny-slider';

let orders = Array.from(document.querySelectorAll('.account__order'));
let menu = Array.from(document.querySelectorAll('.account__header'));

if (orders.length > 0) {
    toggleOrders();
}

if (menu.length > 0) {
    menuOrder();
}

function toggleOrders() {
    let toggleButtons = Array.from(document.querySelectorAll('.account__order-header-button--toggle'));
    let toggleHistoryButtons = Array.from(document.querySelectorAll('.account__order-header-button--history'));
    let historyItemClass = 'account__order-history';
    let historyItemClassShow = 'account__order-history--show';
    let historyButtonCloseClass = 'account__order-history-close';
    let orderClass = 'account__order';
    let orderClassShow = 'account__order--show';

    for (let $toggleButton of toggleButtons) {
        $toggleButton.addEventListener('click', event => {
            event.target.closest('.' + orderClass).classList.toggle(orderClassShow);
        });
    }

    for (let $toggleHistoryButton of toggleHistoryButtons) {
        let $historyItem = $toggleHistoryButton.querySelector('.' + historyItemClass);

        if (viewportOptions.hoverAvailability) {
            $toggleHistoryButton.addEventListener('mouseenter', () => {
                $historyItem.classList.add(historyItemClassShow);
            });

            $toggleHistoryButton.addEventListener('mouseleave', () => {
                $historyItem.classList.remove(historyItemClassShow);
            });
        } else {
            let $closeButton = $toggleHistoryButton.querySelector('.' + historyButtonCloseClass);

            $toggleHistoryButton.addEventListener('click', () => {
                $historyItem.classList.toggle(historyItemClassShow);
            });

            document.addEventListener('click', event => {
                if (!event.target.closest('.account__order-header-button--history') && event.target !== $toggleHistoryButton) {
                    $historyItem.classList.remove(historyItemClassShow);
                }
            });

        }
    }

}

function menuOrder() {
    let $slider = document.querySelector('.account__header-buttons');
    let $nav = document.querySelector('.account__header-nav');

    let mobileBreakpoint = 1024;
    let currentWidth = viewportOptions.viewportWidth;
    let mobileType = false;
    let slider;
    let isInitSlider = false;

    if (currentWidth < mobileBreakpoint) {
        mobileType = true;
    }

    window.addEventListener('resize', () => {
        currentWidth = viewportOptions.viewportWidth;

        if (currentWidth < mobileBreakpoint) {
            if (!mobileType) {
                mobileType = true;
                toggleSlider();
            }
        } else {
            if (mobileType) {
                mobileType = false;
                toggleSlider();
            }
        }
    });

    toggleSlider();

    function toggleSlider() {
        if (mobileType) {
            if (!isInitSlider) {
                slider = tns({
                    container: $slider,
                    autoWidth: false,
                    items: 1,
                    loop: true,
                    gutter: 0,
                    speed: 400,
                    controls: true,
                    controlsContainer: $nav,
                    nav: false,
                    touch: true,
                    mouseDrag: true,
                    responsive: {
                        1024: {
                            loop: false,
                            autoWidth: false,
                        },
                    },
                    onInit: () => {
                        isInitSlider = true;
                        console.log(slider);
                    },
                });
            } else {
                slider = slider.rebuild();
            }
        } else {
            if (isInitSlider) {
                slider.destroy();
            }
        }
    }


}