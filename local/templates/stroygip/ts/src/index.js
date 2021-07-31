import {preload} from "./blocks/preload/preload";
import {initOrderPreviewsGrid} from "./blocks/previews-grid/previews-grid";
import {initPreviewsSlider} from "./blocks/previews-slider/previews-slider";
import {initNaturalBannerSlider} from "./blocks/natural-banner/natural-banner";


class GetViewportOptions {

    constructor() {
        this.viewportWidth = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        this.viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
        this.scrollbarWidth = this.getScrollWidth();
        this.hoverAvailability = this.getHoverAvailability();
        this.#setup();
    }

    #setup() {
        // Переопределение ширины и высоты при ресайзе
        window.addEventListener('resize', () => {
            this.viewportWidth = document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            this.viewportHeight = document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            console.log('window.innerWidth ' + window.innerWidth)
            console.log('document.documentElement.clientWidth ' + document.documentElement.clientWidth)
            console.log('document.getElementsByTagName(\'body\')[0].clientWidth ' + document.getElementsByTagName('body')[0].clientWidth)
        });
    }

    // Функция определения ширины скролла
    getScrollWidth() {
        let div = document.createElement('div');
        let width = 0;
        div.style.overflowY = 'scroll';
        div.style.width = '50px';
        div.style.height = '50px';
        document.body.append(div);
        width = div.offsetWidth - div.clientWidth;
        div.remove();
        return width;
    }

    // Функция определения поддержки ховера
    getHoverAvailability() {
        let style = document.createElement('style');
        style.textContent = `
                :root {
                    --hover-device:false;
                }
                @media (hover) {
                    :root {
                        --hover-device:true;
                    }
                }
            `;

        document.body.append(style);
        let hover = getComputedStyle(document.getElementsByTagName('body')[0]).getPropertyValue('--hover-device');

        if (hover === 'false') {
            return false;
        } else {
            return true;
        }


    }

    getViewportWidth() {
        return this.viewportWidth;
    }

    getViewportHeight() {
        return this.viewportHeight;
    }

    getFullOptions() {
        return {
            viewportWidth: this.viewportWidth,
            viewportHeight: this.viewportHeight,
            scrollbarWidth: this.scrollbarWidth,
            hoverAvailability: this.hoverAvailability
        };
    }
}

window.mobileWidth = 1279;
window.mobileWidthSmall = 768;
window.viewportOptions = new GetViewportOptions();

const loadMain = () => {
    preload(document.getElementById('main-group'), loadNatural);
};

const loadNatural = () => {
    preload(document.getElementById('natural-group'), sliders);
};

const sliders = () => {
    initOrderPreviewsGrid();
    initPreviewsSlider();
    initNaturalBannerSlider();
};

if (!document.getElementsByTagName('body')[0].classList.contains('clear-page')) {
    loadMain();
}