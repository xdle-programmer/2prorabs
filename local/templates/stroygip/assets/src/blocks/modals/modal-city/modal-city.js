$(function (){
        btnCity = $('#select-city'),
        modalCity = $('.modal-overlay, .modal-position, .modal-city');

    btnCity.on('click', function() {
        modalCity.fadeIn(200);
    });
    $('.modal-city__close, .modal-overlay').click(function (){
        modalCity.fadeOut(200);
    });


    $(".modal-city__input").focus(function() {
        $(this).siblings(".modal-city__label").addClass("modal-city__label-color");
    });

    $(".modal-city__input").blur(function() {

        let $this = $(this),
            val = $this.val();

        if(val.length >= 1){
            $(this).siblings(".modal-city__label").removeClass("modal-city__label-color");
            $(this).siblings(".modal-city__label").addClass("modal-city__label-active");
        }else {
            $(this).siblings(".modal-city__label").removeClass("modal-city__label-color");
            $(this).siblings(".modal-city__label").removeClass("modal-city__label-active");
        }
    });
})