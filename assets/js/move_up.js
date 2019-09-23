/*left-move_up-panel */
$(window).scroll(function() {
    if ($(this).scrollTop() > 400) {
        $('#move_up').fadeIn(600);
        $('#b1').css({'background-color':'#cfcfcf'});
    } else {
        $('#move_up').fadeOut(600);
        $('#b1').css({'background-color':'transparent'});
    }
});
/* move_up */
$('#move_up').click(function() {
    $('html').animate({
        scrollTop: 0
    }, 0);
    return false;
});
$('#b1').click(function() {
    $('html').animate({
        scrollTop: 0
    }, 0);
    return false;
});