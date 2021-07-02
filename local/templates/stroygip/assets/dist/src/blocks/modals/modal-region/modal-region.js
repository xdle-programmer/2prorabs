$(function (){
        btn = $('.open-modal-region'),
        modal = $('.modal-overlay, .modal-position, .modal-region');

    btn.on('click', function() {
        modal.fadeIn(200);
    });
    $('.modal-region__close, .modal-overlay').click(function (){
        modal.fadeOut(200);
    });
});