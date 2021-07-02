import GetViewportOptions from 'get-viewport-options';
import {preload} from "./blocks/preload/preload";
import {initOrderPreviewsGrid} from "./blocks/previews-grid/previews-grid";
import {initPreviewsSlider} from "./blocks/previews-slider/previews-slider";
import {initNaturalBannerSlider} from "./blocks/natural-banner/natural-banner";

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

loadMain();