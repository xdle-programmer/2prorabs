$(function (){
    $(".feedback-area__input").focus(function() {
        $(this).siblings(".feedback-area__label").addClass("feedback-area__label-color");
    });

    $(".feedback-area__input").blur(function() {

        let $this = $(this),
            val = $this.val();

        if(val.length >= 1){
            $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color");
            $(this).siblings(".feedback-area__label").addClass("feedback-area__label-active");
        }else {
            $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-color");
            $(this).siblings(".feedback-area__label").removeClass("feedback-area__label-active");
        }
    });
});