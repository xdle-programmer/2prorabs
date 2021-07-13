let ratingsEditable = Array.from(document.querySelectorAll('.rating--editable'));

if (ratingsEditable.length > 0) {
    for (let $rating of ratingsEditable) {
        handlerRating($rating);
    }
}

function handlerRating($wrapper) {
    let $stars = $wrapper.querySelectorAll('.rating__star');
    let $input = $wrapper.querySelector('input');

    for (let index = 0; index < $stars.length; index++) {
        $stars[index].addEventListener('click', handlerClick.bind(null, index));
    }

    function handlerClick(target) {
        let starActive = 'rating__star--active';
        $input.value = target;

        for (let index = 0; index < $stars.length; index++) {
            if (index <= target) {
                $stars[index].classList.add(starActive);
            } else {
                $stars[index].classList.remove(starActive);
            }
        }
    }

}