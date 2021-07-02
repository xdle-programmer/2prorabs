$('.personal-area__list-header-detail').click(function () {
    $(this).toggleClass('personal-area__list-header-detail--active')
    $('.personal-area__history').toggleClass('personal-area__history--show');
    $('.personal-area__history-box').toggleClass('personal-area__history-box--show')
})

let menuButton = $('.personal-area__menu-button'),
    panelMobile = $('.personal-area__panel-container--mobile');

menuButton.click(function () {
    panelMobile.toggleClass('personal-area__panel-container--show');
});




$('.personal-area__organizations-input').click(function (){
    if($(this).prop("checked") == true){
        $(this).parent().children('.personal-area__organizations-hint').show(0, function (){
            setTimeout(function (){
                $('.personal-area__organizations-hint').hide(500);
            }, 3000);
        });
    }
})