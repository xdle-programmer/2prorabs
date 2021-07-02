$(".input-styled__input").focus(function() {
    $(this).siblings(".input-styled__label").addClass("input-styled__label-color");
});

$(".input-styled__input").blur(function() {

    let $this = $(this),
        val = $this.val();

    if(val.length >= 1){
        $(this).siblings(".input-styled__label").removeClass("input-styled__label-color");
        $(this).siblings(".input-styled__label").addClass("input-styled__label-active");
    }else {
        $(this).siblings(".input-styled__label").removeClass("input-styled__label-color");
        $(this).siblings(".input-styled__label").removeClass("input-styled__label-active");
    }
});
