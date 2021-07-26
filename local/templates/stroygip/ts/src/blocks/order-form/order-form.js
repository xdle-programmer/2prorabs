let radioDelivery = Array.from(document.querySelectorAll('input[name="delivery_id"]'));


if (radioDelivery.length > 0) {
    radioDeliveryHandler();
}

function radioDeliveryHandler() {
    let hideClass = 'order-form__group--hide';
    let forms = document.querySelectorAll('[data-delivery]');

    for (let $input of radioDelivery) {
        $input.addEventListener('change', () => {

            for (let $form of forms) {
                $form.classList.add(hideClass);
            }
            document.querySelector('[data-delivery="' + event.target.value + '"]').classList.remove(hideClass);
        });
    }
}

