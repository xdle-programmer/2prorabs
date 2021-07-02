/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

'use strict';

;( function( $, window, document, undefined )
{
    $( '.inside__inputfile' ).each( function()
    {
        let $input	 = $( this ),
            $label	 = $input.next( 'label' ),
            labelVal = $label.html();

        $input.on( 'change', function( e )
        {
            let fileName = '';

            if( this.files && this.files.length > 1 ){
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            }
            else if( e.target.value ) {
                fileName = e.target.value.split( '\\' ).pop();
                $('.inside__inputfile-delete').addClass('inside__inputfile-delete--active');
                $('.inside__file-block').addClass('inside__file-block--active')
            }


            if( fileName ){
                $label.find( 'span' ).html( fileName );
            }

            else{
                $label.html( labelVal );
                $('.inside__inputfile-delete').removeClass('inside__inputfile-delete--active');
                $('.inside__file-block').removeClass('inside__file-block--active')
            }

        });

        // Firefox bug fix
        $input
            .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
            .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
    });
})( jQuery, window, document );

$('.inside__inputfile-delete').click(function (){
    $( '.inside__inputfile' ).val('').change();
})