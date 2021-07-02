window.viewportWidth = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
window.viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
window.scrollTop = 128;
window.scrollDownDirection;
window.mobileWidth;

// вычисление ширины скролла
window.scrollbarWidth = function getScrollWidth() {
// создадим элемент с прокруткой
    let div = document.createElement('div');
    let width = 0;

    div.style.overflowY = 'scroll';
    div.style.width = '50px';
    div.style.height = '50px';
    document.body.append(div);
    width = div.offsetWidth - div.clientWidth;
    div.remove();
    return width;
};

