$('.product-review-form').on('submit', (e) => {
    e.preventDefault();
    const $el = $(e.currentTarget).closest('.product-review-form');

    let formData = {
        formId: 'product_review',
        _protect: 'XJuQ52GmKW',
        productId: app.pageData.productId,
        name: $el.find('[name="name"]').val(),
        email: $el.find('[name="email"]').val(),
        text: $el.find('[name="text"]').val(),
    };

    BX.ajax.runComponentAction('nav:form', 'submit', {
        mode: 'class',
        data: formData,
    }).then(response => {
        if (!response.data) {
            alert('Произошла ошибка, попробуйте ещё раз');
            return;
        }

        if (response.data.status !== 'ok') {
            alert(response.data.error);
            return;
        }

        $el.find('.product-review-form__form').addClass('hidden');
        $el.find('.product-review-form__success').removeClass('hidden');
    });
});