class BasketPage {
    constructor() {
        this.onChangeQuantityDebounced = debounce(this.onChangeQuantity.bind(this), 300);
        this.bind();
    }

    bind() {
        $('.tq_inc').off('click').on('click', function () {
            let $this = $(this),
                input = $this.closest('.amount-input__sum').find('input'),
                quantity = parseInt(input.val()),
                max = input.attr('max');
            if (quantity + 1 <= max) {
                input.val(quantity + 1).change();
            }
        });

        $('.tq_dec').off('click').on('click', function () {
            let $this = $(this),
                input = $this.closest('.amount-input__sum').find('input'),
                quantity = parseInt(input.val());
            if (quantity - 1 > 0) {
                input.val(quantity - 1).change();
            }
        });

        $('#basket .amount-input__sum-input').on('change', this.onChangeQuantityDebounced.bind(this));
    }

    onChangeQuantity(e) {
        let data = {
            action: 'updatebasket',
            id: $(e.currentTarget).attr('data-id'),
            quantity: $(e.currentTarget).val(),
        };

        $.ajax({
            url: "/local/templates/stroygip/ajax/ajax.php",
            type: "POST",
            dataType: 'json',
            data: data,
        }).done((response) => {
            $.get( "/local/templates/stroygip/ajax/basketupdate.php", (data) => {
                $('#basket').html(data);
                this.bind();
            });
        });
    }
}

$(() => { window.controller = new BasketPage(); });

