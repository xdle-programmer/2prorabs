// Start styled inputs
$(".basket-products__registration-input").focus(function () {
    $(this).siblings(".basket-products__registration-label").addClass("basket-products__registration-label-color");
});

$(".basket-products__registration-input").blur(function () {

    let $this = $(this),
        val = $this.val();

    if (val.length >= 1) {
        $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-color");
        $(this).siblings(".basket-products__registration-label").addClass("basket-products__registration-label-active");
    } else {
        $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-color");
        $(this).siblings(".basket-products__registration-label").removeClass("basket-products__registration-label-active");
    }
});
// End styled inputs

// select tabs
$('.basket-products__delivery-buttons').on('click', '.basket-products__delivery-button:not(.basket-products__delivery-button--active)', function() {
    $(this)
        .addClass('basket-products__delivery-button--active').siblings().removeClass('basket-products__delivery-button--active')
        .closest('.basket-products__container-tabs').find('.basket-products__content').removeClass('basket-products__content--active').eq($(this).index()).addClass('basket-products__content--active');
});
// end select tabs

// close warning
$('.basket-products__warning-close').click(function (){
    $('.basket-products__warning').hide(200);
})
// end close warning

// combobox
$( function() {
    $.widget( "custom.combobox", {
        _create: function() {
            this.wrapper = $( "<span>" )
                .addClass( "custom-combobox" )
                .insertAfter( this.element );

            this.element.hide();
            this._createAutocomplete();
            // this._createShowAllButton();
        },

        _createAutocomplete: function() {
            var selected = this.element.children( ":selected" ),
                value = selected.val() ? selected.text() : "";

            this.input = $( "<input>" )
                .appendTo( this.wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: $.proxy( this, "_source" )
                })
                .tooltip({
                    classes: {
                        "ui-tooltip": "ui-state-highlight"
                    }
                });

            this._on( this.input, {
                autocompleteselect: function( event, ui ) {
                    ui.item.option.selected = true;
                    this._trigger( "select", event, {
                        item: ui.item.option
                    });
                },

                autocompletechange: "_removeIfInvalid"
            });
        },

        // _createShowAllButton: function() {
        //     var input = this.input,
        //         wasOpen = false;
        //
        //     $( "<a>" )
        //         .attr( "tabIndex", -1 )
        //         .attr( "title", "Show All Items" )
        //         .tooltip()
        //         .appendTo( this.wrapper )
        //         .button({
        //             icons: {
        //                 primary: "ui-icon-triangle-1-s"
        //             },
        //             text: false
        //         })
        //         .removeClass( "ui-corner-all" )
        //         .addClass( "custom-combobox-toggle ui-corner-right" )
        //         .on( "mousedown", function() {
        //             wasOpen = input.autocomplete( "widget" ).is( ":visible" );
        //         })
        //         .on( "click", function() {
        //             input.trigger( "focus" );
        //
        //             // Close if already visible
        //             if ( wasOpen ) {
        //                 return;
        //             }
        //
        //             // Pass empty string as value to search for, displaying all results
        //             input.autocomplete( "search", "" );
        //         });
        // },

        _source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
                var text = $( this ).text();
                if ( this.value && ( !request.term || matcher.test(text) ) )
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }) );
        },

        _removeIfInvalid: function( event, ui ) {

            // Selected an item, nothing to do
            if ( ui.item ) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
                valueLowerCase = value.toLowerCase(),
                valid = false;
            this.element.children( "option" ).each(function() {
                if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                    this.selected = valid = true;
                    return false;
                }
            });

            // Found a match, nothing to do
            if ( valid ) {
                return;
            }

            // Remove invalid value
            this.input
                .val( "" )
                .attr( "title", value + " город не найден" )
                .tooltip( "open" );
            this.element.val( "" );
            this._delay(function() {
                this.input.tooltip( "close" ).attr( "title", "" );
            }, 2500 );
            this.input.autocomplete( "instance" ).term = "";
        },

        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });

    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
        $( "#combobox" ).toggle();
    });
} );
// end combobox


//
// $("#combobox").focus(function () {
//     $(".select-label").addClass("select-label__label-color");
//     console.log($(".select-label"))
// });
//
// $("#combobox").blur(function () {
//
//     let $this = $(this),
//         val = $this.val();
//
//     if (val.length >= 1) {
//         $(this).siblings(".select-label").removeClass("select-label__label-color");
//         $(this).siblings(".select-label").addClass("select-label__label-active");
//     } else {
//         $(this).siblings(".select-label").removeClass("select-label__label-color");
//         $(this).siblings(".select-label").removeClass("select-label__label-active");
//     }
// });
