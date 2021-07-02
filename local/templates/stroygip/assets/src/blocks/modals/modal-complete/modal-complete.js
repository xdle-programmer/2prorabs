btnComplete = $('#buttonComplete'),
modalComplete = $('.modal-overlay, .modal-position, .modal-complete');

btnComplete.on('click', function() {
    modalComplete.show();
});
$('.modal-complete__close, .modal-overlay').click(function (){
    modalComplete.hide();
});
