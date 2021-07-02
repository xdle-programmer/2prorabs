$('#minusSum').click(function () {
    let $input = $('#calculatorSum');
    let count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
});

$('#plusSum').click(function () {
    let $input = $('#calculatorSum');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
});