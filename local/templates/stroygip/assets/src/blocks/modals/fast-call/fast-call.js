btnCall = $('#fastCall'),
    modalCall = $('.modal-overlay, .modal-position, .fast-call');

btnCall.on('click', function() {
    modalCall.show();
});
$('.fast-call__close, .modal-overlay').click(function (){
    modalCall.hide();
});