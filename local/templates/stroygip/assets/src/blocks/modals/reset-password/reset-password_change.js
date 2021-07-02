btnChange = $('#buttonChange'),
    modalChange = $('.modal-overlay, .modal-position,  .reset-password-change');

btnChange.on('click', function() {
    modalChange.show();
});
$('#closeChange, .modal-overlay').click(function (){
    modalChange.hide();
});
