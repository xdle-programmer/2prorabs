$(() => {
    // Disable old click handler from dist/main.js
    $('.modal-registration__button').off('click').on('click', (e) => {
        const $block = $('.modal-registration__add-company-block');

        if ($block.parents('.modal-registration__organization-hidden-container').length > 0) {
            $('.modal-registration__organization-container').append($block);
        } else {
            $('.modal-registration__organization-hidden-container').append($block);
        }
    });
});
function startTimer(formatTime,counterTime,form){
    $('#repeat_send').html('').hide();
    $('.modal-registration__code-timer').show();
    $('#tq_timer').html('00:'+formatTime);
    let timerId = setInterval(function () {
        counterTime--;
        if(counterTime<10){
            formatTime = '0'+counterTime;
        }else{
            formatTime = counterTime;
        }
        $('#tq_timer').html('00:'+formatTime);
        if(counterTime == 0){
            clearInterval(timerId);
            $('#repeat_send').html('<button class="button button--red button--red-width modal-registration__button-red" data-form="'+form+'" id="tq_repeat_send" type="button">Получить код повторно</button>').show();
            $('.modal-registration__code-timer').hide();
        }

    }, 1000);
}

$(document).on('submit','#tq_auth_phone',function () {
   let phone = $(this).find('[name=PHONE]').val(),
       captcha_word = $(this).find('[name=g-recaptcha-response]').val();
    //captcha_code = $(this).find('[name=captcha_sid]').val();
    back_url = $(this).find('[name=back_url]').val();
    BX.ajax.runComponentAction('2quick:tq_auth',
        'sendCodeAuth', { // Вызывается без постфикса Action
            mode: 'class',
            data: {phone: phone,captcha_word:captcha_word,back_url:back_url}, // ключи объекта data соответствуют параметрам метода
        })
        .then(function (response) {
            if(response.data.CAPTCHA_CODE){
                $('.modal-registration__captcha img').attr('src',response.data.CAPTCHA_IMG)
                $('.modal-registration__captcha [name=captcha_sid]').val(response.data.CAPTCHA_CODE)
                $('[name=captcha_word]').val('');
            }
            if (response.data.STATUS === 'SUCCESS') {
                $('.tq_error').html('').hide()
                $('#sended_phone').html(response.data.PHONE)
                $('#tq_confirm_code').show();
                $('#tq_register_container').hide();
                startTimer(response.data.TIME_FORMAT,response.data.TIME,'tq_auth_phone')
            } else {
                $('#tq_auth_phone').find('.tq_error').html(response.data.MESSAGE).show()
                $('#tq_confirm_code').hide();
                $('#tq_register_container').show();
            }
        });
    return false
});



function modalUserReg() {
	var formData = new FormData(document.getElementById('tq_form_registration'));
	formData.append('captcha_word', document.getElementsByClassName('g-recaptcha-response')[1].value );
	
	BX.ajax.runComponentAction('2quick:tq_auth', 'sendCodeReg', {
        mode: 'class',
        data: formData,
    }).then(function (response) {
		if (response.data.STATUS === 'SUCCESS') {
			if(response.data.BACK_URL){
				location.href = response.data.BACK_URL
			}else{
				location.reload();
			}
		} else {
			var d1 = document.querySelector('div.tq_error_reg');
			d1.innerHTML = response.data.MESSAGE;
			document.getElementById('tq_confirm_code').style.display = 'none';
			document.getElementById('tq_register_container').style.display = 'inline-block';
		}
    });

}

$(document).on('click','#tq_form_registration .modal-registration__button-red',function () {
	$('form#tq_form_registration').submit();
});

$('#tq_form_registration').on('submit', function (e) {
    const formData = new FormData(e.currentTarget);
    formData.append('captcha_word', $(this).find('[name="g-recaptcha-response"]').val());

    BX.ajax.runComponentAction('2quick:tq_auth', 'sendCodeReg', {
        mode: 'class',
        data: formData,
    }).then(function (response) {
            /*if (response.data.CAPTCHA_CODE) {
                $('.modal-registration__captcha img').attr('src', response.data.CAPTCHA_IMG)
                $('.modal-registration__captcha [name=captcha_sid]').val(response.data.CAPTCHA_CODE)
                $('[name=captcha_word]').val('');
            }*/
            if (response.data.STATUS === 'SUCCESS') {
                if(response.data.BACK_URL){
                    location.href = response.data.BACK_URL
                }else{
                    location.reload();
                }
               /* $('.tq_error').html('').hide()
                $('#sended_phone').html(response.data.STATUS).hide()
                $('#tq_confirm_code').show();
                $('#tq_register_container').hide();
                startTimer(response.data.TIME_FORMAT, response.data.TIME, 'tq_form_registration')*/
            } else {
                $('#tq_form_registration').find('.tq_error').html(response.data.MESSAGE).show()
                $('#tq_confirm_code').hide();
                $('#tq_register_container').show();
            }

    });

    return false
});




function modalUserAuth() {
	let email = document.getElementById('input-auth-email').value,
	password = document.getElementById('input-auth-password').value,
	captcha_word = document.getElementsByClassName('g-recaptcha-response')[0].value;

	BX.ajax.runComponentAction('2quick:tq_auth',
		'Auth', {
			mode: 'class',
			data: {email: email,password:password,captcha_word:captcha_word},
	}).then(function (response) {
		if (response.data.STATUS === 'SUCCESS') {
			location.reload();
		} else {
			var d1 = document.querySelector('div.tq_error_auth');
			d1.innerHTML = response.data.MESSAGE;
		}
	});
}

$(document).on('click','#tq_auth_email .modal-registration__button-red',function () {
	$('form#tq_auth_email').submit();
});

$(document).on('submit','#tq_auth_email',function () {
   let email = $(this).find('[name=EMAIL]').val(),
       password = $(this).find('[name=PASSWORD]').val(),
       captcha_word = $(this).find('[name=g-recaptcha-response]').val();
    //captcha_code = $(this).find('[name=captcha_sid]').val();
    BX.ajax.runComponentAction('2quick:tq_auth',
        'Auth', { // Вызывается без постфикса Action
            mode: 'class',
            data: {email: email,password:password,captcha_word:captcha_word}, // ключи объекта data соответствуют параметрам метода
        })
        .then(function (response) {
            /*if(response.data.CAPTCHA_CODE){
                $('.modal-registration__captcha img').attr('src',response.data.CAPTCHA_IMG)
                $('.modal-registration__captcha [name=captcha_sid]').val(response.data.CAPTCHA_CODE)
                $('[name=captcha_word]').val('');
            }*/
            if (response.data.STATUS === 'SUCCESS') {
               location.reload();
            } else {
                $('#tq_auth_email').find('.tq_error').html(response.data.MESSAGE).show()
            }
        });
    return false
})


$(document).on('keyup', '#tq_confirm_code input',function () {
        if($(this).val().length == 4){
            BX.ajax.runComponentAction('2quick:tq_auth',
                'checkCode', { // Вызывается без постфикса Action
                    mode: 'class',
                    data: {code: $(this).val()}, // ключи объекта data соответствуют параметрам метода
                })
                .then(function (response) {
                    if(response.data.BACK_URL){
                        location.href = response.data.BACK_URL
                    }else{
                        if (response.data.STATUS === 'SUCCESS') {
                            if(response.data.TYPE == 'AUTHORIZED'){
                                location.reload();
                            }
                        } else {
                            $('#tq_confirm_code input').val('');
                            if(response.data.TYPE == 'OPEN_FORM'){
                                $(response.data.ID +' .tq_error').html(response.data.MESSAGE).show();
                                $('#tq_confirm_code').hide();
                                $(response.data.ID).show();
                            }else{
                                $('#tq_confirm_code .tq_error').html(response.data.MESSAGE).show();
                            }

                        }
                    }

                });
        }


    return false;
})

$(document).on('click','#tq_repeat_send',function () {
    let form = $(this).attr('data-form')
    BX.ajax.runComponentAction('2quick:tq_auth',
        'RepeatCode', { // Вызывается без постфикса Action
            mode: 'class',
        })
        .then(function (response) {
            if (response.data.STATUS === 'SUCCESS') {
                $('.tq_error').html('').hide()
                startTimer(response.data.TIME_FORMAT,response.data.TIME,form)
            } else {
                $('#tq_confirm_code').find('.tq_error').html(response.data.MESSAGE).show()
            }
        });
})