function ajaxUpdate(){
    $.get( "/local/templates/stroygip/ajax/basketupdate.php", function( data ) {
        $('#basket').html(data);
        BX.onCustomEvent('OnBasketChange');
    });
}
function UpdateFavComp() {
    $.ajax({
        url: "/local/templates/stroygip/ajax/basket.php",
        type: "POST",
        dataType: 'json',
        data: {action:'countfavcomp'},
        success: function (data) {

            $('.dds_fav_count').html(data.TEXT);
            $('.dds_fav_quan').attr('data-quantity',data.FAV);
        }
    });
}

const debounce = (func, wait) => {
    let timeout;

    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

$(document).on('click', '[data-show-more]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more');
    var bx_ajax_id = btn.attr('data-ajax-id');
    var block_id = "#comp_"+bx_ajax_id;

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        success: function(data) {
            //delete old html
            $("#btn_"+bx_ajax_id).remove();

            if(btn.parent().hasClass('news__button-all')){
                $('.news__pagination').remove();

                let items = $(data).find('.news__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.news__pagination');

                $('.news__grid').append(items);
                $('.news__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.news__grid').after(pagen);
                }
            }

            if(btn.parent().hasClass('stock__button-all')){
                $('.stock__pagination').remove();

                let items = $(data).find('.stock__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.stock__pagination');

                $('.stock__grid').append(items);
                $('.stock__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.stock__grid').after(pagen);
                }
            }

            if(btn.parent().hasClass('vacancies__button-all')){
                $('.vacancies__pagination').remove();

                let items = $(data).find('.vacancies__item');
                let button = $(data).find($("#btn_"+bx_ajax_id));
                let pagen = $(data).find('.vacancies__pagination');

                $('.vacancies__grid').append(items);
                $('.vacancies__grid').after(button);

                if(button.length>0) {
                    $("#btn_"+bx_ajax_id).after(pagen);
                } else {
                    $('.vacancies__grid').after(pagen);
                }
            }

        }
    });
});
$(document).on('click', '[data-show-more-catalog]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more-catalog');
    var bx_ajax_id = btn.attr('data-ajax-id');
    var block_id = "#comp_"+bx_ajax_id;

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        dataType: 'html',
        timeout: 3000,
        success: function(data) {
            $("#btn_"+bx_ajax_id).html($(data).find("#btn_"+bx_ajax_id).html());
            $(block_id).find('.catalog-category__products-grid').append($(data).find('.catalog-category__products-grid').html());
        }
    });
});
let ajaxaction;
$(document).on('click change submit','[data-action]',function(e){
    var action = $(this).attr('data-action');
    var $this = $(this);
    var data = {};
    data['action'] = action;

    switch (e.type){
        case 'click':
            switch (action){
                case 'add2basket':
                    var id = $this.attr('data-id');
                    data['id'] = id;
                    data['quantity'] = $('.ddsQuantity').val();
					
					if( $('.imp-item-quantity-value[data-id="'+ id +'"]').length  ){
						data['quantity'] = parseInt( $('.imp-item-quantity-value[data-id="'+ id +'"]').html() );
					}
					
                    break;

                case 'delete':
                    data['id'] = $this.attr('data-id');
                    break;
                case 'compfav':
                    data['id'] = $this.attr('data-id');
                    data['add'] = $this.attr('data-add');
                    break;
                case 'compfavdelete':
                    data['id'] = $this.attr('data-id');
                    data['add'] = $this.attr('data-add');
                    break;
                case 'clearCompare':
                    data['id'] = $this.attr('data-id');
                    break;
                case 'setCoupon':
                    data['coupon'] = $('#input-bonuses').val();
                    break;
                default:
                    return false;
                    break;
            }
            break;
        case 'change':
            switch (action){
                case 'updatebasket':
                    data['id'] = $this.attr('data-id');
                    data['quantity'] = $this.val();
                    break;
                default:
                    return false;
                    break;
            }
            break;

        case 'submit':
        default:
            return false;
            break;
            break;
    }
    if(ajaxaction)
        ajaxaction.abort;
    ajaxaction = $.ajax({
        url: "/local/templates/stroygip/ajax/ajax.php",
        type: "POST",
        dataType: 'json',
        data: data,
        success: function (result) {
            switch (action){
                case 'add2basket':
                    //alert('Товар добавлен в корзину');
                    //$this.html('Добавлено');
                    break;
                case 'compfav':
                    $this.attr('data-action','compfavdelete');
                    $this.toggleClass('compfavactive');
                    break;
                case 'compfavdelete':
                    $this.attr('data-action','compfav');
                    $this.toggleClass('compfavactive');
                    let $el = $(e.currentTarget).closest('.catalog-category__item');
                    $el.fadeOut(() => $el.remove());
                    break;
                case 'clearCompare':
                   location.href = '/compare/';
                    break;
                case 'setCoupon':
                    /*$.ajax({
                        url: "/local/templates/stroygip/ajax/ajax.php",
                        type: "POST",
                        dataType: 'json',
                        data: {action:'getCouponList'},
                        success: function (result) {
                           console.log(result);
                        }
                    });*/
                        break;
            }
            ajaxUpdate();
        }
    });
    return false;
});

$(() => {
    $('#ORDER').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "/local/templates/stroygip/ajax/order.php",
            type: "POST",
            dataType: 'json',
            data: $(this).serialize(),
            success: function (result) {
                if (result.STATUS == "ERROR") {
                    $('.errorcostum').html(result.HTML);
                }
            }
        });
    });

    $('.ddsQuantity').on('change', function () {
        let el = $(this);
        let currency = el.data('currency');
        let price = el.data('price');
        let discount_price = el.data('discount-price');
        let quantity = el.val();
        if(quantity<1) {
            quantity = 1;
        }
        if(price != 'undefined') {
            el.parents('.tqWrap').find('.product-card__price').html((Math.round(discount_price*quantity * 10) / 10) +'<span class="product-card__price-prefix">'+currency+'</span>');
        }
        if(discount_price != 'undefined') {
            el.parents('.tqWrap').find('.product-card__discount').html((Math.round(price*quantity * 10) / 10)+'<span class="product-card__price-prefix">'+currency+'</span>');
        }
    });

    $('select[data-selectmenu]').selectmenu({
        change: (event, ui) => $(event.target).trigger('change'),
    });
});

$(document).on('submit','#personalDataUpdate',function () {;
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
        }
    });

    return false;
})

$(document).on('submit','#personalAddressAdd',function () {;
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
        }
    });

    return false;
})

$(document).on('click','[data-address]',function () {
    let action = $(this).attr('data-action');
    let id = $(this).attr('data-address');
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: {action: action, id: id},
        success: function (result) {
            $('#dataUpdated').show();
            $('#dataUpdated').parents('.modal-position').show();
            $('.modal-overlay').show();
            setTimeout(function () {
                location.reload();
            }, 2000);
        }
    });

    return false;
})

$(document).on('click','#buttonRegBasket',function () {
    $('[name=back_url]').val('/order/')
    modalReg.show()
})
$(document).on('click','#buttonReg',function () {
    $('[name=back_url]').val('')
})


function CallPrint(elem) {
    var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
    var prtCSS = '<link rel="stylesheet" href="/local/templates/stroygip/assets/dist/libs.css" type="text/css" /><link rel="stylesheet" href="/local/templates/stroygip/assets/dist/style.css" type="text/css" /><link rel="stylesheet" href="/local/templates/stroygip/template_styles.css" type="text/css" />';
    WinPrint.document.write('<div class="personal-area__list u-no-transition">');
    WinPrint.document.write(prtCSS);
    WinPrint.document.write(elem.html());
    WinPrint.document.write('</div>');
    WinPrint.document.close();
    WinPrint.focus();
    setTimeout(() => {
        WinPrint.print();
    }, 200);
}

$(document).on('click','.saveEstimate',function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: "/local/templates/stroygip/ajax/personal_data_update.php",
        type: "POST",
        data: {action: 'estimate_create', order_id: id},
        success: function (result) {

        }
    });
});
//Промокоды
$(document).on('click','#sendPromocode',function () {
    let promocode = $('#input-bonuses').val();
    if(promocode.length >0) {
        $.ajax({
            url: "/local/templates/stroygip/ajax/promocode.php",
            type: "POST",
            dataType:'json',
            data: {promocode: promocode},
            success: function (result) {
                $('.show_messages').removeClass('red');
                if(result.STATUS =='SUCCSESS') {
                  let cur_points = +$('.personal-area__card-scores').text();
                  let promocode_points = +result.POINTS;
                  $('.personal-area__card-scores').text(cur_points+promocode_points);
                } else {
                  $('.show_messages').addClass('red');
                }
                $('.show_messages').text(result.MSG);
            }
        });
    }
    return false;
});

$(document).on('click','#sendPromocode',function () {
    let promocode = $('#input-bonuses').val();
    if(promocode.length >0) {
        $.ajax({
            url: "/local/templates/stroygip/ajax/promocode.php",
            type: "POST",
            dataType:'json',
            data: {promocode: promocode},
            success: function (result) {
                $('.show_messages').removeClass('red');
                if(result.STATUS =='SUCCSESS') {
                    let cur_points = +$('.personal-area__card-scores').text();
                    let promocode_points = +result.POINTS;
                    $('.personal-area__card-scores').text(cur_points+promocode_points);
                } else {
                    $('.show_messages').addClass('red');
                }
                $('.show_messages').text(result.MSG);
            }
        });
    }
    return false;
});
$(document).on('click','.tqTabs',function () {
    let section_id = $(this).data('id');
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: {SECTION_ID:section_id},
        success: function (data) {
            $('.news__content').addClass('news__content--active');
            $('.news__content').html($(data).find('.news__content').html());
        }
    });
});

$(document).on('click','.dds-plus',function () {
    let $input = $('#calculatorSum');
    let step = Math.round(parseFloat($input.attr('data-step')) * 10) / 10;
    $input.val(Math.round(parseFloat(parseFloat($input.val()) + step) * 10) / 10);
    $input.change();
    return false;
});


$(document).on('click','.dds-minus',function () {
    let $input = $('#calculatorSum');
    let step = Math.round(parseFloat($input.attr('data-step')) * 10) / 10;
    let count = parseFloat($input.val()) - step;
    count = count <= 0 ? step : count;
    $input.val(Math.round(parseFloat(count) * 10) / 10);
    $input.change();
    return false;
});

$('.regButton, .js-registration-popup').on('click',function (e) {
    e.preventDefault();

    $(".modal-overlay, .modal-position, .modal-registration-container").show();
    $('.regTab').click();
});

$(document).on('click','.regTab,.authTab',function () {
    let passwordModal = $(".reset-password");
        if(passwordModal.is(":visible")) {
            passwordModal.hide();
        }
    return false;
});

$(() => {
    $('.js-footer-feedback').on('click', (e) => {
        e.preventDefault();

        $('.modal-overlay').show();
        $('.feedback-modal').closest('.modal-position').show();
        $('.feedback-modal').show();
    });

    $('.feedback-modal__button').on('click', function (e) {
        e.preventDefault();
        const $form = $(e.currentTarget).closest('.feedback-modal');

        let formData = {
            formId: 'feedback',
            name: $form.find('[name="name"]').val(),
            phone: $form.find('[name="phone"]').val(),
            email: $form.find('[name="email"]').val(),
            text: $form.find('[name="text"]').val(),
            _protect: 'XJuQ52GmKW',
            ajax: 'Y',
            sessid: app.sessid,
        };

        if (!formData.name) {
            alert('Введите имя');
            return;
        }

        if (!formData.phone) {
            alert('Введите телефон');
            return;
        }

        if (!formData.email) {
            alert('Введите email');
            return;
        }

        if (!formData.text) {
            alert('Введите текст сообщения');
            return;
        }

        $.ajax({
            url: '/local/public/feedback_form.php',
            type: 'post',
            data: formData,
            dataType: 'json',
        }).done((response) => {
            if (response.status === 'error') {
                alert(response.error);
                return;
            }

            $form.find('.feedback-modal__input-box').hide();
            $form.find('.feedback-modal__img-box').hide();
            $form.find('.feedback-modal__title').text('Спасибо!');
        });
    });

    $('input[data-phone-mask]').inputmask({
        'mask': '+\\9\\96 999-999-999'
    });
});


$(document).on('click','#order_help_call ',function () {
    if( $("#order_help_button").hasClass("form-check__button--disabled") ){
		console.log('empty fields');
	}else{
		var user_name = $("#ohf_name").val();
		var user_mail_phone = $("#ohf_mailphone").val();
		
		$.post("/local/public/call_me2.php", {name: user_name, mail_phone: user_mail_phone}, function(data){
			if( data.length > 0 ){
				$("#ohf_name").val("");
				$("#ohf_mailphone").val("");
			}
		});
	}
});

