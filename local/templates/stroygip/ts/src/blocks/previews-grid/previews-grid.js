import {tns} from 'tiny-slider/src/tiny-slider';
import {setWidthImgPreview} from '../set-width-img-preview/set-width-img-preview';

export function initOrderPreviewsGrid() {
    const previewsGrids = Array.from(document.querySelectorAll('.previews-grid'));

    if (previewsGrids.length > 0) {
        for (let $previewsGrid of previewsGrids) {
            createOrderPreviewsGrid($previewsGrid);
        }
    }

    function createOrderPreviewsGrid($wrapper) {
        let $slider = $wrapper.querySelector('.previews-grid__slider');
        let slider = false;
        let sliderType;
        let breakpoint = 1320;
        let items = Array.from($slider.querySelectorAll('.previews-grid__item'));
        const $nav = $wrapper.querySelector('.previews-grid__nav');
        const prototype = $slider.dataset.grid.split('-');
        const desktopCountItem = prototype.length;
        const smallItemClass = 'previews-grid__item--small';
        const middleItemClass = 'previews-grid__item--middle';
        const bigItemClass = 'previews-grid__item--big';
        const sizes = {
            s: {
                column: 2,
                row: 1,
            },
            m: {
                column: 2,
                row: 2,
            },
            b: {
                column: 3,
                row: 2,
            },
        };

        const typeS = 's';
        const typeM = 'm';
        const typeB = 'b';

        const desktopColumnCount = 7;
        const desktopRowCount = 2;

        init();

        function init() {
            if (window.viewportOptions.viewportWidth <= breakpoint) {
                groupSlidesMobile();

                sliderType = 'mobile';
            } else {
                groupSlidesDesktop();

                sliderType = 'desktop';
            }
        }

        function createDesktopGridArea() {
            let gridArea = [[], []];
            let currentColumn = 0;
            let currentRow = 0;

            for (let index = 0; index < prototype.length; index++) {
                let type = prototype[index];
                let size = sizes[prototype[index]];

                if (type === typeS && !gridArea[currentRow + 1][currentColumn - size.column]) {
                    gridArea[currentRow + 1][currentColumn - size.column] = 'item_' + index;
                    gridArea[currentRow + 1][currentColumn - size.column + 1] = 'item_' + index;
                } else {
                    for (let column = 0; column < size.column; column++) {
                        for (let row = 0; row < size.row; row++) {
                            gridArea[currentRow + row][currentColumn + column] = 'item_' + index;
                        }
                    }

                    currentColumn += size.column;
                }

            }

            gridArea = sliceRowsGridArea(gridArea);

            gridArea = fillEmpty(gridArea);

            gridArea = createGridAreaRow(gridArea);

            function sliceRowsGridArea(gridArea) {
                let needSlice = false;
                let currentLength = gridArea.length;

                if (gridArea[currentLength - 1].length > desktopColumnCount || gridArea[currentLength - 2].length > desktopColumnCount) {
                    needSlice = true;
                }

                if (!needSlice) {
                    return gridArea;
                }

                let row0 = gridArea[currentLength - 2].slice(0, desktopColumnCount);
                let row1 = gridArea[currentLength - 1].slice(0, desktopColumnCount);
                let row2 = gridArea[currentLength - 2].slice(desktopColumnCount);
                let row3 = gridArea[currentLength - 1].slice(desktopColumnCount);

                gridArea[currentLength - 2] = row0;
                gridArea[currentLength - 1] = row1;
                gridArea[currentLength] = row2;
                gridArea[currentLength + 1] = row3;

                return gridArea;
            }

            function fillEmpty(gridArea) {
                for (let indexRow = 0; indexRow < gridArea.length; indexRow++) {

                    for (let indexCol = 0; indexCol < desktopColumnCount; indexCol++) {
                        if (indexCol === gridArea[indexRow].length) {
                            gridArea[indexRow].push('.');
                        }
                    }
                }

                return gridArea;
            }

            function createGridAreaRow(gridArea) {
                let row = '';

                for (let index = 0; index < gridArea.length; index++) {
                    row += '"';
                    row += gridArea[index].join(' ');
                    row += '" ';
                }
                return row;
            }

            return gridArea;
        }

        function groupSlidesDesktop() {
            let slides = [];
            let slideTemplate = createDesktopGridArea();

            for (let index = 0; index < Math.ceil(items.length / desktopCountItem); index++) {
                slides.push([]);
            }

            for (let index = 0; index < items.length; index++) {
                let currentSlideNumber;

                if (index >= desktopCountItem) {
                    currentSlideNumber = Math.floor(index / desktopCountItem);
                } else {
                    currentSlideNumber = 0;
                }

                let type = prototype[index - (currentSlideNumber * desktopCountItem)];

                items[index].classList.remove(smallItemClass);
                items[index].classList.remove(middleItemClass);
                items[index].classList.remove(bigItemClass);

                if (type === 's') {
                    items[index].classList.add(smallItemClass);
                } else if (type === 'm') {
                    items[index].classList.add(middleItemClass);
                } else if (type === 'b') {
                    items[index].classList.add(bigItemClass);
                }

                slides[currentSlideNumber].push(items[index]);
            }

            for (let slideIndex = 0; slideIndex < slides.length; slideIndex++) {
                let fragment = document.createDocumentFragment();

                let slide = document.createElement('div');
                let slideWrapper = document.createElement('div');
                slide.classList.add('previews-grid__slide');
                slideWrapper.classList.add('previews-grid__slide-wrapper');
                slide.style.gridTemplateAreas = slideTemplate;
                slideWrapper.appendChild(slide);

                for (let itemIndex = 0; itemIndex < slides[slideIndex].length; itemIndex++) {
                    slides[slideIndex][itemIndex].style.gridArea = 'item_' + itemIndex;

                    slide.appendChild(slides[slideIndex][itemIndex]);
                }

                fragment.appendChild(slideWrapper);
                $slider.appendChild(slideWrapper);
            }

            $slider = $wrapper.querySelector('.previews-grid__slider');
        }

        function groupSlidesMobile() {
            for (let slideIndex = 0; slideIndex < items.length; slideIndex++) {
                let fragment = document.createDocumentFragment();
                let slide = document.createElement('div');
                let slideWrapper = document.createElement('div');
                slide.classList.add('previews-grid__slide');
                slideWrapper.classList.add('previews-grid__slide-wrapper');
                slideWrapper.appendChild(slide);
                slide.appendChild(items[slideIndex]);
                fragment.appendChild(slideWrapper);
                $slider.appendChild(slideWrapper);
            }

            $slider = $wrapper.querySelector('.previews-grid__slider');
        }

        slider = tns({
            container: $slider,
            autoWidth: false,
            loop: false,
            gutter: 20,
            swipeAngle: false,
            speed: 400,
            controls: false,
            controlsContainer: $nav,
            nav: false,
            mouseDrag: false,
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
                1160: {
                    items: 4,
                },
                1320: {
                    items: 1,
                    controls: true,
                },
            },
            onInit: () => {
                window.addEventListener('resize', resizeHandler);

                let previews = $wrapper.querySelectorAll('.product-cart__block')

                for (let $preview of previews) {
                    setWidthImgPreview($preview)
                }
            },
        });

        function resizeHandler() {
            let prevSliderType = sliderType;

            if (window.viewportOptions.viewportWidth <= breakpoint) {
                sliderType = 'mobile';
            } else {
                sliderType = 'desktop';
            }

            if (prevSliderType === sliderType) {
                return;
            }

            slider.destroy();
            unwrapSlides();
            init();
            slider = slider.rebuild();
        }

        function unwrapSlides() {
            $slider = $wrapper.querySelector('.previews-grid__slider');
            items = Array.from($slider.querySelectorAll('.previews-grid__item'));

            for (let $item of items) {
                $slider.insertAdjacentElement('beforeend', $item);
            }

            for (let $slideWrapper of $slider.querySelectorAll('.previews-grid__slide-wrapper')) {
                $slideWrapper.remove();
            }
        }
    }
}