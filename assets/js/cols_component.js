display = Math.round(100 * jQuery('#b3').width() / jQuery('#b3').parent().width());
jQuery('.view').masonry('layout');
jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());
if (display != '100') {
    jQuery('#fullscreen-message').toggleClass('hidden');
    jQuery('#fullscreen-message').animate({
        opacity: 0.25,
        top: '-50',
        height: 'toggle'
    }, 5000);
    jQuery('#b1').hide();
    jQuery('#b2').hide();
    jQuery('#header').hide();
    jQuery('#b3').css('width', '100%');
    jQuery('#b4').toggleClass('absolutepanel');
    jQuery('#b4').toggle(function (jQuery) {
        jQuery('#b4').animate({
            right: '-165px'
        }, 500);
    }, function () {
        jQuery('#b4').animate({
            right: 0
        }, 500);
    });
    jQuery('#nent').css('max-width', '100%');
    jQuery('#b3').css('padding-left', '0');
    jQuery('#nent').css('margin-left', '4px');
    jQuery('#nent').css('margin-right', '4px');
    jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-resize-small');
    jQuery('.view').masonry('layout');
} else {
    jQuery('#b1').show();
    jQuery('#b2').show();
    jQuery('#header').show();
    jQuery('#b3').css('width', '');
    jQuery('#b4').css('background-color', 'transparent');
    jQuery('#b4').toggleClass('absolutepanel');
    jQuery('#b4').css('right', 'inherit!important');
    jQuery('#nent').css('max-width', '817px');
    jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
    jQuery('#b4').css('right', 'inherit');
    jQuery('#b4').unbind('click');
    jQuery('.view').masonry('layout');
}
//jQuery('.view').masonry('layout');
jQuery(document).keyup(function (e) {
    display = Math.round(100 * jQuery('#b3').width() / jQuery('#b3').parent().width());
    if (e.keyCode == 27) {
        if (display == '100') {
            jQuery('#fullscreen-message').toggleClass('hidden');
            jQuery('#b1').show();
            jQuery('#b2').show();
            jQuery('#header').show();
            jQuery('#b3').css('width', '');
            jQuery('#b4').toggleClass('absolutepanel');
            jQuery('#b4').css('width', '');
            jQuery('#b4').css('position', 'relative');
            jQuery('#b4').css('background-color', 'transparent');
            jQuery('#b4').css('right', 'inherit');
            jQuery('#b4').removeClass('absolutepanel');
            jQuery('#b4').unbind('click');
            jQuery('#nent').css('max-width', '817px');
            jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
            jQuery('.view').masonry('layout');
        }
    } else {
        jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
        jQuery('.view').masonry('layout');
    }
//  jQuery('.view').masonry('layout');
//  jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());
});
jQuery(document).ready(function (jQuery) {
    jQuery('#fullscreen-btn').click(function () {
        display = Math.round(100 * jQuery('#b3').width() / jQuery('#b3').parent().width());
        jQuery('.view').masonry('layout');
    });
});
jQuery(document).keyup(function (e) {
    if (e.keyCode == 27) {
        if (display == '100') {
            jQuery('#fullscreen-message').toggleClass('hidden');
            jQuery('#b1').show();
            jQuery('#b2').show();
            jQuery('#header').show();
            jQuery('#b3').css('width', '');
            jQuery('#b4').toggleClass('absolutepanel');
            jQuery('#b4').css('width', '');
            jQuery('#b4').css('position', 'relative');
            jQuery('#b4').css('background-color', 'transparent');
            jQuery('#b4').css('right', 'inherit');
            jQuery('#b4').removeClass('absolutepanel');
            jQuery('#b4').unbind('click');
            jQuery('#nent').css('max-width', '817px');
            jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
            jQuery('.view').masonry('layout');
        }
    } else {
        jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());

    }
});
jQuery(document).ready(function () {
    if (cookie_cols != 'undefined') {
        var cookie_cols = jQuery.cookie('cookie_cols');
    } else {
        cookie_cols = '22%';
    }
    ;
    jQuery('.spacer').css('text-align', 'center');
    jQuery('.spacer').css('padding', '0');
    jQuery('.browse').css('margin', '2px');
    jQuery('.browse').css('width', cookie_cols);
    jQuery('div.addtocart-bar').addClass('hidden-xs');
    jQuery('form.formfavorit').addClass('hidden-xs');
    jQuery(window).load(function () {
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());
    });

    jQuery('#col1').click(function () {
        jQuery.cookie('cookie_cols', '100%');
        jQuery('.spacer').css('text-align', 'left');
        jQuery('.spacer').css('padding', '0px 10px');
        jQuery('.browse').css('margin', '5');
        jQuery('.browse').css('width', '100%');
        jQuery('.category-vendor-avatar').css('height', '160px');
        jQuery('.category-vendor-avatar').css('width', '160px');
        jQuery('div.addtocart-bar').removeClass('hidden-xs');
        jQuery('form.formfavorit').removeClass('hidden-xs');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());
    });
    jQuery('#col2').click(function () {
        jQuery.cookie('cookie_cols', '48%');
        cookie_cols = jQuery.cookie('cookie_cols');
        jQuery('.spacer').css('text-align', 'left');
        jQuery('.spacer').css('padding', '0px 10px');
        jQuery('.browse').css('margin', '4px');
        jQuery('.browse').css('width', '48%');
        jQuery('.category-vendor-avatar').css('height', '100px');
        jQuery('.category-vendor-avatar').css('width', '100px');
        jQuery('div.addtocart-bar').removeClass('hidden-xs');
        jQuery('form.formfavorit').removeClass('hidden-xs');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());

    });
    jQuery('#col3').click(function () {
        jQuery.cookie('cookie_cols', '33%');
        cookie_cols = jQuery.cookie('cookie_cols');
        jQuery('.spacer').css('text-align', 'left');
        jQuery('.spacer').css('padding', '0px 10px');
        jQuery('.browse').css('margin', '3px');
        jQuery('.browse').css('width', '33%');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());

    });
    jQuery('#col4').click(function () {
        jQuery.cookie('cookie_cols', '23%');
        cookie_cols = jQuery.cookie('cookie_cols');
        jQuery('.spacer').css('text-align', 'center');
        jQuery('.spacer').css('padding', '0');
        jQuery('.browse').css('margin', '2px');
        jQuery('.browse').css('width', '23%');
        jQuery('.category-vendor-avatar').css('height', '65px');
        jQuery('.category-vendor-avatar').css('width', '65px');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());

    });
    jQuery('#addtzip').on('click', function () {
        jQuery('.zip').toggleClass('disabled');
        var bl = jQuery('#nent').find('.masonry-brick');
        if (bl.length == 0) {
            bl = jQuery('#nent').find('.browse.browsecellwidth')
        }
        var f = bl.find('form.product');
        bl.find('.check').toggleClass('push');
        console.log(f);
        var prId = f.find('[name="virtuemart_product_id[]"] , [name="quantity[]"]').clone();
        prId.appendTo('form.product.all > .hide_block');
        console.log(prId);
    });
    setTimeout(function () {
        jQuery('.popover').each(function () {
            jQuery(this).popover('hide');
        });
    }, 4000);

    function hideDiv() {
        jQuery('.popover').delay(3000).fadeOut();
    }

    jQuery('#folders').click(function () {
        jQuery('.folders').toggleClass('hide');
        jQuery('#spanfolders').toggleClass('glyphicon-folder-open glyphicon-folder-close');
        jQuery('.view').masonry('layout');
        jQuery('#b1,#b2,#b3,#b4').css('height', jQuery('#nent').height());
    });
});
