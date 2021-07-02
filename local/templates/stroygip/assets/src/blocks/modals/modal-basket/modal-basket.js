btnOrder = $('#basketOrder'),
    modalOrder = $('.modal-overlay, .modal-position, .modal-basket');

btnOrder.on('click', function() {
    modalOrder.show();
});
$('.modal-basket__close, .modal-overlay').click(function (){
    modalOrder.hide();
});