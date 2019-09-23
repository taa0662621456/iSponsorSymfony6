/* fullscreen and escape */
function openbox(id) {
    display = Math.round(100 * jQuery('#b3').width() / jQuery('#b3').parent().width());
    if (display != '100') {
        jQuery('#fullscreen-message').toggleClass('hidden');
        jQuery("#fullscreen-message").animate({opacity: 0.25, top: "-50", height: "toggle"}, 5000);
        jQuery('#b1').hide();
        jQuery('#b2').hide();
        jQuery('#header').hide();
        jQuery('#b3').css('width', '100%');
        jQuery('#b4').toggleClass('absolutepanel');
        jQuery("#b4").toggle(function ($) {
            jQuery("#b4").animate({right: '-165px'}, 500);
        }, function () {
            jQuery("#b4").animate({right: 0}, 500);
        });
        jQuery('#nent').css('max-width', '100%');
        jQuery('#b3').css('padding-left', '0');
        jQuery('#nent').css('margin-left', '5px');
        jQuery('#nent').css('margin-right', '5px');
        jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-resize-small');
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
    }
    jQuery('.view').masonry('layout');
};jQuery(document).keyup(function (e) {
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
        }
    } else {
        jQuery('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
    }
    jQuery('.view').masonry('layout');
});