import Validation from 'form-validation-expandable';

let forms = Array.from(document.querySelectorAll('.form-check'));

window.formsArray = new Map();

if (forms.length > 0) {
    for (let index = 0; index < forms.length; index++) {
        if (forms[index].id !== '') {
            window.formsArray.set(forms[index].id, new Validation({
                $form: forms[index],
            }));

            window.formsArray.get(forms[index].id).init();
        } else {
            window.formsArray.set('i' + index, new Validation({
                $form: forms[index],
            }));

            window.formsArray.get('i' + index).init();
        }
    }
}