$(function () {
    // Активация лейбла на инпуте
    $(".product-description__input").focus(function () {
        $(this).siblings(".product-description__label").addClass("product-description__label-color");
    });
    $(".product-description__input").blur(function () {
        let $this = $(this),
            val = $this.val();

        if (val.length >= 1) {
            $(this).siblings(".product-description__label").removeClass("product-description__label-color");
            $(this).siblings(".product-description__label").addClass("product-description__label-active");
        } else {
            $(this).siblings(".product-description__label").removeClass("product-description__label-color");
            $(this).siblings(".product-description__label").removeClass("product-description__label-active");
        }
    });
    // Показать и скрыть крестик в инпуте
    $(".product-description__input").keypress(function() {
        if($(this).val().length >= 0) {
            $('.product-description__input-reset').show();
        }
    });
    $(".product-description__input").keyup(function() {
        if($(this).val().length <= 0) {
            $('.product-description__input-reset').hide();
        }
    });
    // Крестик удаляет содержимое инпута
    $('.product-description__input-reset').click(function(){
        $('.product-description__input').val('').change();
    });
    // Табы
    $('.product-description__tabs').on('click', '.product-description__tab:not(.product-description__tab--active)', function() {
        $(this)
            .addClass('product-description__tab--active').siblings().removeClass('product-description__tab--active')
            .closest('.product-description__container').find('.product-description__content-box').removeClass('product-description__content-box--active').eq($(this).index()).addClass('product-description__content-box--active');
    });
});