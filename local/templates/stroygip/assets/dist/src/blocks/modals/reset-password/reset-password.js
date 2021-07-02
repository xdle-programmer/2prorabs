btnReset = $('#buttonReset'),
    modalReset = $('.modal-overlay, .modal-position,  .reset-password');

btnReset.on('click', function() {
    modalReset.show();
});
$('.reset-password__close, .modal-overlay').click(function (){
    modalReset.hide();
});
