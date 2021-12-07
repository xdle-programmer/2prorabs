const searchHints = Array.from(document.querySelectorAll('.search-hints'));
import axios from "axios";

searchHints.forEach(($searchHint) => {
    handlerSearchHints($searchHint);
});

function handlerSearchHints($wrapper) {
    const id = $wrapper.id;
    const $input = $wrapper.querySelector('.search-hints__input');
    const $onButtons = Array.from(document.querySelectorAll(`[data-search-hints-open="${id}"]`));
    const $closeButtons = $wrapper.querySelectorAll('[data-search-hints-close]');
    const closeButtonData = 'data-search-hints-close';

    const $templateProductsItem = $wrapper.querySelector('[data-search-hints-products-item]');
    const $templateHistoryItem = $wrapper.querySelector('[data-search-hints-history-item]');
    const $templatePopularItem = $wrapper.querySelector('[data-search-hints-popular-item]');
    const $templateCategoryItem = $wrapper.querySelector('[data-search-hints-category-item]');

    const $wrapperProducts = $wrapper.querySelector('[data-search-hints-products]');
    const $wrapperHistory = $wrapper.querySelector('[data-search-hints-history]');
    const $wrapperPopular = $wrapper.querySelector('[data-search-hints-popular]');
    const $wrapperCategory = $wrapper.querySelector('[data-search-hints-category]');

    const wrapperClass = 'search-hints';
    const activeClass = 'search-hints--active';
    const resultItemClass = 'search-hints__hints-results-item';
    const resultItemHideClass = 'search-hints__hints-results-item--hide';

    init();

    function init() {
        addListeners();
        setData(window.searchHintInitData);
    }

    function addListeners() {
        $input.addEventListener('input', () => {

            if ($input.value.length > 0) {
                const request = {
                    request: $input.value
                };

                axios.post(window.searchHintUrl, request)
                    .then((response) => {
                        setData(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                setData(window.searchHintInitData);
            }
        });


        document.addEventListener('click', (event) => {
            const $target = event.target;

            // Если клик по инпуту
            if ($target === $input) {
                $wrapper.classList.add(activeClass);
                return;
            }

            // Если клик непосредственно по кнопке открытия
            if ($target.dataset.searchHintsOpen && $target.dataset.searchHintsOpen === `${id}`) {
                $wrapper.classList.add(activeClass);
                return;
            }

            // Если клик непосредственно по чему-то внутри кнопки открытия
            if ($target.closest(`[data-search-hints-open]`) && $target.closest(`[data-search-hints-open]`).dataset.searchHintsOpen === `${id}`) {
                $wrapper.classList.add(activeClass);
                return;
            }

            // Если клик непосредственно по кнопке закрытия
            if ($target.attributes['data-search-hints-close'] && ($target.attributes['data-search-hints-close'] !== '' && $target.attributes['data-search-hints-close'] !== null)) {
                $wrapper.classList.remove(activeClass);
                return;
            }

            // Если клик непосредственно по чему-то внутри кнопки закрытия
            if ($target.closest(`[data-search-hints-close]`)) {
                $wrapper.classList.remove(activeClass);
                return;
            }

            // Если клик по врапперу или по его обертке
            if ($target === $wrapper || $target.closest(`.${wrapperClass}`) === $wrapper) {
                return;
            }

            $wrapper.classList.remove(activeClass);
        });
    }

    function setData(obj) {
        if (obj.products.length > 0) {
            $wrapperProducts.innerHTML = '';

            obj.products.forEach((product) => {
                const $clone = document.importNode($templateProductsItem.content, true);
                const $img = $clone.querySelector('.search-hints__product-img');
                const $name = $clone.querySelector('.search-hints__product-desc-name');
                const $price = $clone.querySelector('.search-hints__product-desc-control-price-number');
                const $buyButton = $clone.querySelector('.search-hints__product-desc-control-buy');

                $img.src = product.img;
                $name.innerText = product.name;
                $name.href = product.link;
                $price.innerText = product.price;
                $buyButton.dataset.productId = product.id

                $wrapperProducts.appendChild($clone);
            });
        }

        if (obj.history.length > 0) {
            $wrapperHistory.innerHTML = '';
            $wrapperHistory.closest(`.${resultItemClass}`).classList.remove(resultItemHideClass);

            obj.history.forEach((item) => {
                const $clone = document.importNode($templateHistoryItem.content, true);
                const $link = $clone.querySelector('.search-hints__hints-results-row-link');

                $link.href = item.link;
                $link.innerText = item.name;

                $wrapperHistory.appendChild($clone);
            });
        } else {
            $wrapperHistory.closest(`.${resultItemClass}`).classList.add(resultItemHideClass);
        }

        if (obj.popular.length > 0) {
            $wrapperPopular.innerHTML = '';
            $wrapperPopular.closest(`.${resultItemClass}`).classList.remove(resultItemHideClass);

            obj.popular.forEach((popular) => {
                const $clone = document.importNode($templatePopularItem.content, true);
                const $link = $clone.querySelector('.search-hints__hints-results-row-link');

                $link.href = popular.link;
                $link.innerText = popular.name;

                $wrapperPopular.appendChild($clone);
            });
        } else {
            $wrapperPopular.closest(`.${resultItemClass}`).classList.add(resultItemHideClass);
        }

        if (obj.category.length > 0) {
            $wrapperCategory.innerHTML = '';
            $wrapperCategory.closest(`.${resultItemClass}`).classList.remove(resultItemHideClass);

            obj.category.forEach((category) => {
                const $clone = document.importNode($templateCategoryItem.content, true);
                const $link = $clone.querySelector('.search-hints__hints-results-row-link');

                $link.href = category.link;
                $link.innerText = category.name;

                $wrapperCategory.appendChild($clone);
            });
        } else {
            $wrapperCategory.closest(`.${resultItemClass}`).classList.add(resultItemHideClass);
        }
    }

}
