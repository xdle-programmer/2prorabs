$(function(){
    $('.cooperation__tabs').on('click', '.cooperation__button:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.cooperation__box').find('.cooperation__content').removeClass('active').eq($(this).index()).addClass('active');
    });
})