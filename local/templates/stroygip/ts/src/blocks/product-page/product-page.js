let counters = Array.from(document.querySelectorAll('.product-page__counter'));

if (counters.length > 0) {
    for (let $counter of counters) {
        counterHandler($counter);
    }
}

function counterHandler($counter) {
    let $minus = $counter.querySelector('.product-page__counter-button--minus');
    let $plus = $counter.querySelector('.product-page__counter-button--plus');
    let $value = $counter.querySelector('.product-page__counter-value');
    let $amount = $counter.closest('.product-page__price-block-count').querySelector('.product-page__price-block-count-price-number');
    let max = +$counter.dataset.counterMax;
    let price = +$counter.dataset.price;

    $minus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value <= 1) {
            value = 1;
        } else {
            value -= 1;
        }

        $value.innerText = value;
        setPrice(value)
    });

    $plus.addEventListener('click', () => {
        let value = parseInt($value.innerText);

        if (value >= max) {
            value = max;
        } else {
            value += 1;
        }

        $value.innerText = value;
        setPrice(value)
    });

    function setPrice(value) {
        $amount.innerText = numberWithSpaces(value * price);
    }

    function numberWithSpaces(x) {
        let parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        return parts.join(".");
    }
}