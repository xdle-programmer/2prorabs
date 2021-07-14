export function setWidthImgPreview($preview) {
    let $price = $preview.querySelector('.product-cart__price');
    let $img = $preview.querySelector('.product-cart__img');
    let padding = 15

    let previewWidth = parseInt(window.getComputedStyle($preview).width);
    let imgRight = parseInt(window.getComputedStyle($img).right);
    let priceWidth = parseInt(window.getComputedStyle($price).width);
    let priceLeft = parseInt(window.getComputedStyle($price).left);

    $img.style.width = (previewWidth - imgRight - priceWidth - priceLeft - padding) + 'px';
}