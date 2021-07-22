import {preload} from "../preload/preload";

if (document.querySelector('.menu')) {
    toggleMenu();
}

function toggleMenu() {
    let buttons = Array.from(document.querySelectorAll('[data-menu-target]'));
    let $wrapper = document.querySelector('.menu');
    let wrapperActiveClass = 'menu--active';
    let blocks = document.querySelectorAll('.menu__block');
    let blockActiveClass = 'menu__block--active';
    let dataAttr = 'data-menu-name';
    let bodyOpenClass = 'open-menu';
    let currentScroll;
    let $closeButton = document.querySelector('.menu__close');
    let $logoButton = document.querySelector('.menu__logo');

    for (let $button of buttons) {
        $button.addEventListener('click', handlerClick);
    }

    $closeButton.addEventListener('click', closeMenu);
    $logoButton.addEventListener('click', closeMenu);

    function handlerClick(event) {
        let target;

        if (event.target.dataset.menuTarget) {
            target = event.target.dataset.menuTarget;
        } else {
            target = event.target.closest('[data-menu-target]').dataset.menuTarget;
        }

        openMenu(target);
    }

    function openMenu(target) {
        currentScroll = window.pageYOffset;
        document.getElementsByTagName('body')[0].classList.add(bodyOpenClass);
        $wrapper.classList.add(wrapperActiveClass);

        for (let $block of blocks) {
            $block.classList.remove(blockActiveClass);
        }

        let $targetBlock = document.querySelector(`[ ${dataAttr}=${target}]`);
        $targetBlock.classList.add(blockActiveClass);
        preload($targetBlock);
    }

    function closeMenu() {
        document.getElementsByTagName('body')[0].classList.remove(bodyOpenClass);
        window.scrollTo(0, currentScroll);
        $wrapper.classList.remove(wrapperActiveClass);
    }

}