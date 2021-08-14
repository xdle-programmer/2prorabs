// .static-page__special-header-item.static-page__special-header-item--active(data-target='1') Для физических лиц
//     .static-page__special-item.static-page__special-item--active(data-name='1')


if (document.querySelector('.static-page__special-header-item')) {
    for (let $button of document.querySelectorAll('.static-page__special-header-item')) {
        $button.addEventListener('click', event => {
            let target = event.target.dataset.target;

            for (let $button of document.querySelectorAll('.static-page__special-header-item')) {
                if ($button.dataset.target === target) {
                    $button.classList.add('static-page__special-header-item--active')
                } else {
                    $button.classList.remove('static-page__special-header-item--active')
                }
            }
            for (let $item of document.querySelectorAll('.static-page__special-item')) {
                if ($item.dataset.name === target) {
                    $item.classList.add('static-page__special-item--active')
                } else {
                    $item.classList.remove('static-page__special-item--active')
                }
            }
        });
    }
}

// let storesMaps = Array.from(document.querySelectorAll('.static-page__stores-item-title'));
//
// if (storesMaps.length > 0) {
//     toggleStoresMaps();
// }
//
// function toggleStoresMaps() {
//     let buttons = document.querySelectorAll('.static-page__stores-item-title');
//     let maps = document.querySelectorAll('.static-page__stores-map');
//     let items = document.querySelectorAll('.static-page__stores-item');
//
//     let mapActiveClass = 'static-page__stores-map--active';
//     let itemActiveClass = 'static-page__stores-item--active';
//
//     for (let $button of buttons) {
//         $button.addEventListener('click', event => {
//             let target = event.target.closest('.static-page__stores-item').dataset.storeTarget;
//
//             for (let $item of items) {
//                 if ($item.dataset.storeTarget === target) {
//                     $item.classList.add(itemActiveClass)
//                 } else {
//                     $item.classList.remove(itemActiveClass)
//                 }
//             }
//
//             for (let $map of maps) {
//                 if ($map.dataset.store === target) {
//                     $map.classList.add(mapActiveClass)
//                 } else {
//                     $map.classList.remove(mapActiveClass)
//                 }
//             }
//
//         });
//
//
//     }
//
// // .static-page__stores-map.static-page__stores-map--active(data-store="1")
// }