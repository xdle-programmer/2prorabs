import Select from 'simple-custom-select';

let selects = Array.from(document.querySelectorAll('.custom-select'));

if (selects.length > 0) {
    for (let $select of selects) {
        new Select({
            $select: $select,
        });
    }
}


