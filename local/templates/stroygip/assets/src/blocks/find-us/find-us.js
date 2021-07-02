$(function (){
    $('.find-us__carousel').owlCarousel({
        items: 3,
        merge: true,
        loop: true,
        video: true,
        lazyLoad: true,
        dots: true,
        center: true,
        autoWidth: true,
        autoWidth: true,
        responsive:{
            1201:{
                items:3,
            },
            576:{
                items: 1,
            }
        }
    });
});
// var overlay = document.getElementById('overlay');
// var vid = document.getElementById('video');
//
// if(overlay.addEventListener){
//     overlay.addEventListener("click", play, false)
// }else if(overlay.attachEvent){
//     overlay.attachEvent("onclick", play)
// }
//
// function play() {
//     if (vid.paused){
//         vid.play();
//         vid.controls = true;
//         overlay.className = "o";
//     }else {
//         vid.pause();
//         overlay.className = "o";
//     }
// }