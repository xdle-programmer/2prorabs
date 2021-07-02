export function preload($wrapper, callback) {
    let loadClass = 'preload--not-ready';

    if (!$wrapper.classList.contains(loadClass)) {
        return;
    }

    let items = Array.from($wrapper.querySelectorAll('.preload__item'));
    let states = [];

    for (let $item of items) {

        $item.addEventListener('load', () => {
            states.push(true);
            checkLoadState();
        });

        $item.src = $item.dataset.src;
    }

    function checkLoadState() {
        if (states.length === items.length) {
            $wrapper.classList.remove(loadClass)

            if (callback) {
                callback()
            }
        }
    }

}