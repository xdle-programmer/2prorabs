btnCompleteCompany = $('#buttonCompleteCompany'),
modalCompleteCompany = $('.modal-overlay, .modal-position, .modal-complete-company');

btnCompleteCompany.on('click', function() {
    modalCompleteCompany.show();
});
$('.modal-complete__close, .modal-overlay').click(function (){
    modalCompleteCompany.hide();
});
