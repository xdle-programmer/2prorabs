btnThanks = $('#buttonThanks'),
modalThanks = $('.modal-overlay, .modal-position, .thanks');

btnThanks.on('click', function() {
    modalThanks.show();
});
$('.thanks__close, .modal-overlay').click(function (){
    modalThanks.hide();
});
