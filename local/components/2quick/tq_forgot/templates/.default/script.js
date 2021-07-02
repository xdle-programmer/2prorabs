$(document).on('submit','#forgot_form',function () {
    BX.ajax.runComponentAction('2quick:tq_forgot',
        'sendPass', { // Вызывается без постфикса Action
            mode: 'class',
            data: {email:$(this).find('input[name=EMAIL]').val()}, // ключи объекта data соответствуют параметрам метода
        })
        .then(function(response) {
            if(response.data.STATUS === 'SUCCESS'){
                $('#forgot_form .tq_error').html(response.data.MESSAGE).show();
            }else{
                $('#forgot_form .tq_error').html(response.data.MESSAGE).show();
            }
        });
    return false
});

$(".catalog-menu__submenu-box .catalog-menu__submenu-item-button").click(function () {
    $(this).toggleClass("active");
    if( $(this).hasClass( "active") ){
        $(this).siblings(".catalog-menu__submenu-inner").slideDown();
    }else{
        $(this).siblings(".catalog-menu__submenu-inner").slideUp();
    }
});