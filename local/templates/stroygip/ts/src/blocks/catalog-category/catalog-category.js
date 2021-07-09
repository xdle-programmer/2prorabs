let catalogFilterButtons = Array.from(document.querySelectorAll('.catalog-category__filter-items-button'));

if (catalogFilterButtons.length > 0) {
    toggleCatalogFilter();
    toggleFilter();
}

function toggleCatalogFilter() {
    let $buttons = Array.from(document.querySelectorAll('.catalog-category__filter-items-button'));
    let itemsActiveClass = 'catalog-category__filter-items--active'

    for (let $button of $buttons) {
        $button.addEventListener('click', toggleFilter);
    }

    function toggleFilter(event) {
        let $items = event.target.closest('.catalog-category__filter-items')

        $items.classList.toggle(itemsActiveClass)

    }
}

function toggleFilter() {
    let $openButton = document.querySelector('.catalog-category__items-header-filter');
    let $closeButton = document.querySelector('.catalog-category__filter-close');
    let $wrapper = document.querySelector('.catalog-category__filter');
    let activeClass = 'catalog-category__filter--active'

    $openButton.addEventListener('click', toggleFilterClass);
    $closeButton.addEventListener('click', toggleFilterClass);

    function toggleFilterClass() {
        $wrapper.classList.toggle(activeClass)

    }
}