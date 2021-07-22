let counters = Array.from(document.querySelectorAll('.basket__products-item-desc-count'));

if (counters.length > 0) {
    for (let $counter of counters) {
        counterHandler($counter);
    }
}

function counterHandler($counter) {
    let $minus = $counter.querySelector('.basket__products-item-desc-count-button--minus');
    let $plus = $counter.querySelector('.basket__products-item-desc-count-button--plus');
    let $value = $counter.querySelector('.basket__products-item-desc-count-value');
    let max = +$counter.dataset.counterMax

    console.log(123)

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


