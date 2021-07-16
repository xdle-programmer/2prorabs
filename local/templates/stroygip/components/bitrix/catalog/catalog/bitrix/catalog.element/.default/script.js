/*
class ProductPage {
    constructor() {
        // To override component cache
        $('#product_rating_placeholder').replaceWith($('.product-rating'));
        $('.product-rating').css('display', '');

        this.bind();
    }

    bind() {
        $('.product-card__fast-order').on('click', this.showFastOrderModal.bind(this));
        $('.fast-call__button').on('click', this.onFastOrderSubmit.bind(this));
        $('.product-card__slide-small').on('click', this.onThumbnailClick.bind(this));
    }

    showFastOrderModal(e) {
        e.preventDefault();
        let modalReg = $(".modal-overlay, .modal-position, .fast-call");
        modalReg.show();
    }

    onFastOrderSubmit(e) {
        e.preventDefault();
        const $form = $(e.currentTarget).closest('.fast-call');

        let formData = {
            formId: 'fast_order',
            name: $form.find('[name="name"]').val(),
            phone: $form.find('[name="phone"]').val(),
            productId: app.pageData.productId,
            _protect: 'XJuQ52GmKW',
            ajax: 'Y',
            sessid: app.sessid,
        };

        if (!formData.name) {
            alert('Введите имя');
            return;
        }

        if (!formData.phone) {
            alert('Введите телефон');
            return;
        }

        $.ajax({
            url: '/local/public/fast_order.php',
            type: 'post',
            data: formData,
            dataType: 'json',
        }).done((response) => {
            if (response.status === 'error') {
                alert(response.error);
                return;
            }

            $form.find('.fast-call__input-box').hide();
            $form.find('.fast-call__img-box').hide();
            $form.find('.fast-call__title').text('Спасибо, мы скоро вам перезвоним!');
        });
    }

    onThumbnailClick(e) {
        const url = $(e.currentTarget).find('img').attr('data-big');
        $('.product-card__main-image-box-link').attr('href', url);
        $('.product-card__main-image').attr('src', url);
    }
}

$(() => { window.controller = new ProductPage(); });
*/