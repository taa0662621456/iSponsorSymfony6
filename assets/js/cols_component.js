display = Math.round(100 * $('#b3').width() / $('#b3').parent().width());
$('.view').masonry('layout');
$('#b1,#b2,#b3,#b4').css('height', $('#nent').height());
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
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());

    }
});
$(document).ready(function () {
    if (cookie_cols != 'undefined') {
        var cookie_cols = $.cookie('cookie_cols');
    } else {
        cookie_cols = '22%';
    }
    ;
    $('.spacer').css('text-align', 'center');
    $('.spacer').css('padding', '0');
    $('.browse').css('margin', '2px');
    $('.browse').css('width', cookie_cols);
    $('div.addtocart-bar').addClass('hidden-xs');
    $('form.formfavorit').addClass('hidden-xs');
    $(window).load(function () {
        $('.view').masonry('layout');
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());
    });

    $('#col1').click(function () {
        $.cookie('cookie_cols', '100%');
        $('.spacer').css('text-align', 'left');
        $('.spacer').css('padding', '0px 10px');
        $('.browse').css('margin', '5');
        $('.browse').css('width', '100%');
        $('.category-vendor-avatar').css('height', '160px');
        $('.category-vendor-avatar').css('width', '160px');
        $('div.addtocart-bar').removeClass('hidden-xs');
        $('form.formfavorit').removeClass('hidden-xs');
        $('.view').masonry('layout');
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());
    });
    $('#col2').click(function () {
        $.cookie('cookie_cols', '48%');
        cookie_cols = $.cookie('cookie_cols');
        $('.spacer').css('text-align', 'left');
        $('.spacer').css('padding', '0px 10px');
        $('.browse').css('margin', '4px');
        $('.browse').css('width', '48%');
        $('.category-vendor-avatar').css('height', '100px');
        $('.category-vendor-avatar').css('width', '100px');
        $('div.addtocart-bar').removeClass('hidden-xs');
        $('form.formfavorit').removeClass('hidden-xs');
        $('.view').masonry('layout');
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());

    });
    $('#col3').click(function () {
        $.cookie('cookie_cols', '33%');
        cookie_cols = $.cookie('cookie_cols');
        $('.spacer').css('text-align', 'left');
        $('.spacer').css('padding', '0px 10px');
        $('.browse').css('margin', '3px');
        $('.browse').css('width', '33%');
        $('.view').masonry('layout');
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());

    });
    $('#col4').click(function () {
        $.cookie('cookie_cols', '23%');
        cookie_cols = $.cookie('cookie_cols');
        $('.spacer').css('text-align', 'center');
        $('.spacer').css('padding', '0');
        $('.browse').css('margin', '2px');
        $('.browse').css('width', '23%');
        $('.category-vendor-avatar').css('height', '65px');
        $('.category-vendor-avatar').css('width', '65px');
        $('.view').masonry('layout');
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());

    });
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
        $('#b1,#b2,#b3,#b4').css('height', $('#nent').height());
    });
});
