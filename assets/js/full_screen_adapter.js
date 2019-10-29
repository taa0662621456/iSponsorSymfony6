import jQuery from 'jquery';

(function ($, undefined) {
    let $contentBlock = $('#b3').filter('div');
    let $asideRightPanel = $('#b4').filter('div');
    let $fullscreenMessage = $('#fullscreen-message').filter('div');

    let $display = Math.round(100 * $contentBlock.width() / $contentBlock.parent().width());

    if ($display > '100') {
        $fullscreenMessage.toggleClass('hidden')
            .animate({opacity: 0.25, top: "-50", height: "toggle"}, 5000);

        $('#b1, #b2, #header').hide();

        $contentBlock.css('width', '100%');

        $asideRightPanel.toggleClass('absolutepanel')
            .toggle(function ($) {
                $asideRightPanel.animate({right: '-165px'}, 500);
            }, function () {
                $asideRightPanel.animate({right: 0}, 500);
            });
        $contentBlock
            .css('padding-left', '0');

        // TODO: тут еще непонятно, в новой верстке у нас нет #nent
        $('#nent')
            .css({
                'max-width': '100%',
                'margin-left': '5px',
                'margin-right': '5px'
            });

        $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-resize-small');

    } else {

        $contentBlock.css('width', '');
        $('#b1, #b2, #header').show();

        $asideRightPanel
            .css('background-color', 'transparent')
            .toggleClass('absolutepanel')
            .css('right', 'inherit!important')
            .unbind('click');
        //TODO: нет у нас нент
        $('#nent')
            .css('max-width', '817px');

        $('#full-s-btn')
            .removeAttr('class')
            .addClass('glyphicon glyphicon-fullscreen');
    }

    $('.view').masonry('layout');

    $(document).keypress(function (e) {
        let display = Math.round(100 * $contentBlock.width() / $contentBlock.parent().width());
        if (e.keyCode == 27) {
            if (display == '100') {
                $('#fullscreen-message').toggleClass('hidden');

                $('#b1, #b2, #header').show();
                $contentBlock.css('width', '');
                $asideRightPanel.toggleClass('absolutepanel')
                    .css({'width': '', 'position': 'relative', 'background-color': 'transparent', 'right': 'inherit'})
                    .removeClass('absolutepanel')
                    .unbind('click');

                //TODO: not used #nent
                $('#nent').css('max-width', '817px');

                $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
            }
        } else {
            $('#full-s-btn').removeAttr('class').addClass('glyphicon glyphicon-fullscreen');
        }
        $('.view').masonry('layout');
    });
})(jQuery);
