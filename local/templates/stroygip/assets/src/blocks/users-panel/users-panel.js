$(function (){
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50){
            $('.users-panel').addClass("users-panel--sticky");
        }
        else{
            $('.users-panel').removeClass("users-panel--sticky");
        }
    });
});