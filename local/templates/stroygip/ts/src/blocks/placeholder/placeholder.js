let placeholders = Array.from(document.querySelectorAll('.placeholder'));

if (placeholders.length > 0) {
    for (let $placeholder of placeholders) {
        checkEmptyInput($placeholder);
    }
}

export function checkEmptyInput($wrapper) {
    let not_empty_class = 'placeholder--not-empty';
    let empty_class = 'placeholder--empty';
    let $placeholder;
    let $placeholder_item;
    let $input;

    if (Array.from($wrapper.querySelectorAll('.placeholder__input')).length > 0) {
        $input = $wrapper.querySelector('.placeholder__input');
        $input.addEventListener('input', checkVal);
        $input.addEventListener('change', checkVal);
        checkVal();
    } else {
        $input = $wrapper.querySelector('.placeholder__select');
        $input.addEventListener('change', checkValSelect);
        checkValSelect();
    }

    function checkVal() {
        $placeholder = $input.closest('.placeholder');
        $placeholder_item = $placeholder.querySelector('.placeholder__item');
        if ($input.value.length > 0) {
            $placeholder.classList.add(not_empty_class);
            $placeholder.classList.remove(empty_class);
        } else {
            $placeholder.classList.remove(not_empty_class);
            $placeholder.classList.add(empty_class);
        }
    }

    function checkValSelect() {
        $placeholder = $input.closest('.placeholder');
        $placeholder_item = $placeholder.querySelector('.placeholder__item');
        if ($input.value !== 'default') {
            $placeholder.classList.add(not_empty_class);
            $placeholder.classList.remove(empty_class);
        } else {
            $placeholder.classList.remove(not_empty_class);
            $placeholder.classList.add(empty_class);
        }
    }
}