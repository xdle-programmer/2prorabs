let counters = Array.from(document.querySelectorAll('.product-cart__counter'));

if (counters.length > 0) {
    for (let $counter of counters) {
        counterHandler($counter);
    }
}

function counterHandler($counter) {
    let $minus = $counter.querySelector('.product-cart__counter-button--minus');
    let $plus = $counter.querySelector('.product-cart__counter-button--plus');
    let $value = $counter.querySelector('.product-cart__counter-value');
    let max = +$counter.dataset.counterMax

    // <div className="product-cart__counter" data-counter-max="5">

    $minus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value <= 1) {
            value = 1;
        } else {
            value -= 1;
        }

        $value.innerText = value;
    });

    $plus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value >= max) {
            value = max;
        } else {
            value += 1;
        }

        $value.innerText = value;
    });
}