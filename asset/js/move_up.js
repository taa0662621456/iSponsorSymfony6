var jQuery = require('jquery');

(function ($, undefined) {

    let $moveUp = $('#move_up').filter('div');
    let $moveUpBlock = $('#b1').filter('aside');

    $(window).scroll(function () {

        if ($(this).scrollTop() > 400) {
            $moveUp.fadeIn(600);
            $moveUpBlock.css({'background-color': '#cfcfcf'});
        } else {
            $moveUp.fadeOut(600);
            $moveUpBlock.css({'background-color': 'transparent'});
        }
    });

    $moveUp.click(function () {
        $('html').animate({
            scrollTop: 0
        }, 0);
        return false;
    });

    $moveUpBlock.click(function () {
        $('html').animate({
            scrollTop: 0
        }, 0);
        return false;
    });

})
(jQuery);
