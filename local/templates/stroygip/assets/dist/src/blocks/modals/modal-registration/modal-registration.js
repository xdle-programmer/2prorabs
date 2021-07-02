$('.modal-registration__tabs').on('click', '.modal-registration__tab:not(.basket-products__delivery-button--active)', function() {
    $(this)
        .addClass('modal-registration__tab--active').siblings().removeClass('modal-registration__tab--active')
        .closest('.modal-registration__inner').find('.modal-registration__box').removeClass('modal-registration__box--active').eq($(this).index()).addClass('modal-registration__box--active');
});

btnReg = $('#buttonReg'),
modalReg = $('.modal-overlay, .modal-position, .modal-registration-container');

btnReg.on('click', function() {
    modalReg.show();
});
$('.modal-registration__close, .modal-overlay').click(function (){
    modalReg.hide();
});

$('#addCompany').click(function(){
    $('.modal-registration__add-company-block').toggle();
})

$('#signEmail').click(function (){
        $('.modal-registration__box').find('.modal-registration__sign-block')
        .removeClass('modal-registration__sign-block--active')
        .next()
        .addClass('modal-registration__sign-block--active')
})
$('#signTel').click(function (){
    $('.modal-registration__box').find('.modal-registration__sign-block')
        .removeClass('modal-registration__sign-block--active')
        .prev()
        .addClass('modal-registration__sign-block--active')
})