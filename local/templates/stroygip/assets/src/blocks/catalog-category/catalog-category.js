$(document).ready(function() {

    // Открытие фильтров
    $('.catalog-category__category-name').click(function (){
        $(this).toggleClass('catalog-category__category-name--active').next().slideToggle(100);
    })
    $('.catalog-category__see-all').click(function (){
        $(this).toggleClass('catalog-category__see-all--active').prev($('.catalog-category__box-hidden')).slideToggle(100);
    })


    // Показать и скрыть крестик в инпуте
    $(".catalog-category__range-input").keypress(function() {
        if($(this).val().length >= 0) {
            $('.catalog-category__range-reset').show();
        }
    });
    $(".catalog-category__range-input").keyup(function() {
        if($(this).val().length <= 0) {
            $('.catalog-category__range-reset').hide();
        }
    });
    // Крестик удаляет содержимое инпута
    $('.catalog-category__range-reset').click(function(){
        $('.catalog-category__range-input').val('').change();
    });

    $('.catalog-category__button-filter').click(function (){
        $('.catalog-category__bar').show();
    })
    $('.catalog-category__close').click(function (){
        $('.catalog-category__bar').hide();
    })

    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    });
    $( function() {
        $( "#select1, #select2" ).selectmenu();
    } );
});