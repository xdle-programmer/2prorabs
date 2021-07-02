$(".clearance-problem__input").focus(function() {
    $(this).siblings(".clearance-problem__label").addClass("clearance-problem__label-color");
});

$(".clearance-problem__input").blur(function() {

    let $this = $(this),
        val = $this.val();

    if(val.length >= 1){
        $(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-color");
        $(this).siblings(".clearance-problem__label").addClass("clearance-problem__label-active");
    }else {
        $(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-color");
        $(this).siblings(".clearance-problem__label").removeClass("clearance-problem__label-active");
    }
});