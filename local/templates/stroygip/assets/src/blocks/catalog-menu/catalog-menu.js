let catalogMenuName = 'catalogMenu';

window.catalogMenu = new menu(
    {
        name: catalogMenuName,
        button: '.catalog__button',
        buttonActiveClass: 'catalog__button--open',
        menuBlock: '.catalog-menu',
        menuActiveClass: 'catalog-menu--open',
        background: '.overlay',
        backgroundActiveClass: 'overlay--active'
    }
);

function toggleCatalogMenu() {
    let $desktopToggleButton = $('.catalog-menu__item');
    let desktopActiveClass = 'catalog-menu__item--open';

    if (viewportWidth > mobileWidth) {
        $desktopToggleButton.on('mouseenter', function () {
            $desktopToggleButton.removeClass(desktopActiveClass);
            $(this).addClass(desktopActiveClass);
        });

        $(document).on('change_menu', function (event, name) {
            if (name === catalogMenuName) {
                $desktopToggleButton.removeClass(desktopActiveClass);
                $desktopToggleButton.eq(0).addClass(desktopActiveClass);
            }
        });
    } else {
    }
}

toggleCatalogMenu();

