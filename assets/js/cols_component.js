display = Math.round(100 * $('#b3').width() / $('#b3').parent().width());

if (display != '100') {
    $('#fullscreen-message').toggleClass('hidden');
    $('#fullscreen-message').animate({
        opacity: 0.25,
        top: '-50',
        height: 'toggle'
    }, 5000);
    $('#b1').hide();
    $('#b2').hide();
    $('#header').hide();
    $('#b3').css('width', '100%');
    $('#b4').toggleClass('absolutepanel');
    $('#b4').toggle(function ($) {
        $('#b4').animate({
            right: '-165px'
        }, 500);
    }, function () {
        $('#b4').animate({
            right: 0
        }, 500);
    });
    $('#nent').css('max-width', '100%');
    $('#b3').css('padding-left', '0');
    $('#nent').css('margin-left', '4px');
    $('#nent').css('margin-right', '4px');
    $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-resize-small');
    $('.view').masonry('layout');
} else {
    $('#b1').show();
    $('#b2').show();
    $('#header').show();
    $('#b3').css('width', '');
    $('#b4').css('background-color', 'transparent');
    $('#b4').toggleClass('absolutepanel');
    $('#b4').css('right', 'inherit!important');
    $('#nent').css('max-width', '817px');
    $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
    $('#b4').css('right', 'inherit');
    $('#b4').unbind('click');
    $('.view').masonry('layout');
}
//$('.view').masonry('layout');
$(document).keyup(function (e) {
    display = Math.round(100 * $('#b3').width() / $('#b3').parent().width());
    if (e.keyCode == 27) {
        if (display == '100') {
            $('#fullscreen-message').toggleClass('hidden');
            $('#b1').show();
            $('#b2').show();
            $('#header').show();
            $('#b3').css('width', '');
            $('#b4').toggleClass('absolutepanel');
            $('#b4').css('width', '');
            $('#b4').css('position', 'relative');
            $('#b4').css('background-color', 'transparent');
            $('#b4').css('right', 'inherit');
            $('#b4').removeClass('absolutepanel');
            $('#b4').unbind('click');
            $('#nent').css('max-width', '817px');
            $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
            $('.view').masonry('layout');
        }
    } else {
        $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
        $('.view').masonry('layout');
    }
//  $('.view').masonry('layout');
//  $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());
});
$(document).ready(function ($) {
    $('#fullscreen-btn').click(function () {
        display = Math.round(100 * $('#b3').width() / $('#b3').parent().width());
        $('.view').masonry('layout');
    });
});
$(document).keyup(function (e) {
    if (e.keyCode === 27) {
        if (display === '100') {
            $('#fullscreen-message').toggleClass('hidden');
            $('#b1').show();
            $('#b2').show();
            $('#header').show();
            $('#b3').css('width', '');
            $('#b4').toggleClass('absolutepanel');
            $('#b4').css('width', '');
            $('#b4').css('position', 'relative');
            $('#b4').css('background-color', 'transparent');
            $('#b4').css('right', 'inherit');
            $('#b4').removeClass('absolutepanel');
            $('#b4').unbind('click');
            $('#nent').css('max-width', '817px');
            $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
            $('.view').masonry('layout');
        }
    } else {
        $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
        $('.view').masonry('layout');

    }
});
$(document).ready(function () {

    $('#addtzip').on('click', function () {
        $('.zip').toggleClass('disabled');
        var bl = $('#nent').find('.masonry-brick');
        if (bl.length == 0) {
            bl = $('#nent').find('.browse.browsecellwidth')
        }
        var f = bl.find('form.product');
        bl.find('.check').toggleClass('push');
        console.log(f);
        var prId = f.find('[name="virtuemart_product_id[]"] , [name="quantity[]"]').clone();
        prId.appendTo('form.product.all > .hide_block');
        console.log(prId);
    });
    setTimeout(function () {
        $('.popover').each(function () {
            $(this).popover('hide');
        });
    }, 4000);

    function hideDiv() {
        $('.popover').delay(3000).fadeOut();
    }

    $('#folders').click(function () {
        $('.folders').toggleClass('hide');
        $('#spanfolders').toggleClass('glyphicon-folder-open glyphicon-folder-close');
        $('.view').masonry('layout');
    });
});
