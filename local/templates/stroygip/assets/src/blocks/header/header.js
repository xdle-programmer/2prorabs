headerScroll();

function headerScroll() {
    let $topHeader = $('.header');
    let topHeaderHeight = $topHeader.height();
    let $scrollPanel = $('.scroll-panel');
    let scrollClass = 'scroll-panel--scroll';

    checkHeaderPosition();

    function checkHeaderPosition() {
        let translateScrollPanel = $('body, html').scrollTop();

        if (translateScrollPanel > topHeaderHeight) {
            $scrollPanel.addClass(scrollClass);
            translateScrollPanel = topHeaderHeight;
        } else {
            $scrollPanel.removeClass(scrollClass);
            translateScrollPanel = $('body').scrollTop();
        }

        $scrollPanel.css('transform', 'translateY(' + -translateScrollPanel + 'px)');
        $topHeader.css('transform', 'translateY(' + -translateScrollPanel + 'px)');

        requestAnimationFrame(checkHeaderPosition);
    }
}