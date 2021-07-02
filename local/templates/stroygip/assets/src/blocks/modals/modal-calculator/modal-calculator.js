$(function (){
   let btnCalculator = $('.product-card__calculator'),
       modalCalculator = $('.modal-calculator, .modal-overlay, .modal-position');
    btnCalculator.on('click', function() {
        modalCalculator.show(100);
    });
    $('.modal-calculator__close, .modal-overlay').click(function (){
        modalCalculator.hide(100);
    });
});