$(() => {
    $('.feedback-area').on('submit', (e) => {
        e.preventDefault();
        const $form = $(e.currentTarget);

        if ($form.closest('.container').find('input[name="accept"]').prop('checked') !== true) {
            alert('Вам необходимо согласиться на обработку персональных данных');
            return;
        }

        let formData = {
            formId: 'call_me',
            name: $form.find('[name="name"]').val(),
            phone: $form.find('[name="phone"]').val(),
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
        $.ajax({
            url: '/local/public/call_me.php',
            type: 'post',
            data: formData,
            dataType: 'json',
        }).done((response) => {
            if (response.status === 'error') {
                alert(response.error);
                return;
            }

            alert('Спасибо, мы скоро с вами свяжемся');
        });
    });
});