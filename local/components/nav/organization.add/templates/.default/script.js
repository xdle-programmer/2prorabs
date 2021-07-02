$(() => {
    $('.personal-area__button-organizations-new').on('click', () => {
        const $popup = $('#organizationAddPopup');
        $popup.closest('.modal-registration-container').show();
        $popup.closest('.modal-position').show();
        $('.modal-overlay').show();
    })

    $('.organization-add-popup__form').on('submit', (e) => {
        e.preventDefault();

        const $form = $(e.currentTarget);
        const formData = new FormData($form.get(0));

        BX.ajax.runComponentAction('nav:organization.add', 'submit', {
            mode: 'class',
            data: formData,
        }).then((response) => {
            if (response.data.status !== 'ok') {
                alert(response.data.error);
            }

            document.location.reload();
        });
    });
});