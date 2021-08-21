function modalForgotPass() {	
	var user_email = document.getElementById('input-forgot-email').value;
	var d1 = document.querySelector('div.tq_error_forgotpass');
	
	BX.ajax.runComponentAction('2quick:tq_forgot', 'sendPass', {
        mode: 'class',
        data: {email:user_email},
    }).then(function (response) {
		if (response.data.STATUS === 'SUCCESS') {
			d1.innerHTML = "Новый пароль выслан на почту";
		} else {
			d1.innerHTML = response.data.MESSAGE;
		}
    });

}
