window.menu = function menu(options) {
    let defaultActiveClass = 'active'
    
    let button = options.button;
    let buttonActiveClass = options.buttonActiveClass || defaultActiveClass;
    let menuBlock = options.menuBlock;
    let menuBlockActiveClass = options.menuActiveClass || defaultActiveClass;
    let background = options.background;
    let backgroundActiveClass = options.backgroundActiveClass || defaultActiveClass;
    
    let state = false;
    let buttons = button.split(', ');
    let menuBlocks = menuBlock.split(', ');

    if (background) {
        let backgrounds = background.split(', ');
    }
    

    this.open = function () {
        openMenu();
    };

    this.close = function () {
        closeMenu();
    };

    this.state = function () {
        return state;
    };

    function openMenu() {
        state = true;

        for (let i = 0; i < buttons.length; i++) {
            $(buttons[i]).addClass(buttonActiveClass);
        }

        for (let i = 0; i < menuBlocks.length; i++) {
            $(menuBlocks[i]).addClass(menuBlockActiveClass);
        }

        if (background) {
            for (let i = 0; i < backgrounds.length; i++) {
                $(backgrounds[i]).addClass(backgroundActiveClass);
            }
        }

        $(document).trigger('change_menu');
    }

    function closeMenu() {
        state = false;

        for (let i = 0; i < buttons.length; i++) {
            $(buttons[i]).removeClass(buttonActiveClass);
        }

        for (let i = 0; i < menuBlocks.length; i++) {
            $(menuBlocks[i]).removeClass(menuBlockActiveClass);
        }

        if (background) {
            for (let i = 0; i < backgrounds.length; i++) {
                $(backgrounds[i]).removeClass(backgroundActiveClass);
            }
        }

        $(document).trigger('change_menu');
    }

    $(document).on('click', function (e) {
        let buttonClick = false;
        let menuClick = false;

        for (let i = 0; i < buttons.length; i++) {
            if ($(e.target).closest(buttons[i]).length === 1) {
                buttonClick = true;
            }
        }

        for (let i = 0; i < menuBlocks.length; i++) {
            if ($(e.target).closest(menuBlocks[i]).length === 1) {
                menuClick = true;
            }
        }

        if (state === false) {
            if (buttonClick === true) {
                openMenu();
            }
        } else {
            if (menuClick === false || buttonClick === true) {
                closeMenu();
            }
        }

    });
};