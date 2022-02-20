const moveUp = document.div.querySelectorAll("#move_up")
const moveUpBlock = document.querySelectorAll("#b1")

// window.onload = function () {
window.scroll = function () {

    if (this.scrollY > 400) {
        moveUp.fadeIn(600);
        moveUpBlock.css({'background-color': '#cfcfcf'});
    } else {
        moveUp.fadeOut(600);
        moveUpBlock.css({'background-color': 'transparent'});
    }


}

moveUp.click(function () {
    html.scrollTop({
        scrollY: 0
    }, 0);
    return false;
});

moveUpBlock.click(function () {
    html.scrollTop({
        scrollY: 0
    }, 0);
    return false;
});
