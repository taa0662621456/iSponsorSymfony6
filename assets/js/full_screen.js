import jQuery from 'jquery';
import Cookies from 'js-cookie';
import Masonry from 'masonry-layout';

let grid = document.querySelector('#masonry-grid');
let fullScreenButton = document.querySelector('#full-screen');

if (fullScreenButton !== undefined && grid !== undefined ) {

    (function ($, undefined) {

        let $html = $('html');
        let $hideArray = $('#b1, #b2, #header');
        let $contentBlock = $('#b3').filter('article');
        let $asideRightPanel = $('#b4').filter('div');
        let $fullScreenButton = $('#full-screen').filter('button');
        let $fullScreenMessage = $('#fullscreen-message').filter('div');
        let $fullScreenIcon = $('#fa-full-screen').filter('i');
        let $fullScrIconClass = 'fa-arrows';
        let $fullScrIconPress = 'fa-compress-arrows-alt';
        let $width = 100 * $contentBlock.width() / $contentBlock.parent().width();
        let $masonryBrick = $('.masonry-brick').filter('div');
        let $masonry = new Masonry( grid, {
            // options...
            itemSelector: '.masonry-brick',
        });

        if (Cookies.get('screen')) {
            $masonryBrick.css('width', Cookies.get('screen'));
            $masonry.layout();
        } else {
            $masonryBrick.css('width', '25%');
            $masonry.layout();
        }

        $fullScreenButton.click(function () {

            if (Math.round($width) === 100) {

                $hideArray.show();
                $contentBlock.removeClass('col-lg-12 col-sm-12 col-md-12').addClass('col-lg-8 col-sm-6 col-md-8');

                $asideRightPanel
                    .css('background-color', 'transparent')
                    .toggleClass('absolutepanel')
                    .css('right', 'inherit!important')
                    .unbind('click');

                fullScreenIcon();
                $width = 0;
            } else {
                $contentBlock.removeClass('col-lg-8 col-sm-6 col-md-8').addClass('col-lg-12 col-sm-12 col-md-12');
                $hideArray.hide();
                $asideRightPanel
                    .toggleClass('absolutepanel')
                    .toggle(function () {
                        $asideRightPanel.animate({right: '-165px'}, 500);
                    }, function () {
                        $asideRightPanel.animate({right: 0}, 500);
                    });


                $asideRightPanel
                    .css('background-color', 'transparent')
                    .toggleClass('absolutepanel')
                    .css('right', 'inherit!important')
                    .unbind('click');

                fullScreenIcon();

                $width = 100;
            }

            $masonry.layout();

        });

        $fullScreenButton.on('shown.bs.modal', function () {
            $('#saveFullScreen').trigger('focus')
        });

        $html.keypress(function (e) {

            if (e.keyCode === 27 && $width === 100 ) {
                $fullScreenMessage.modal();
                $hideArray.show();
                $contentBlock.removeClass('col-lg-12 col-sm-12 col-md-12').addClass('col-lg-8 col-sm-6 col-md-8');

                asideRightPanel();
                fullScreenIcon();

                $masonry.layout();
            }

            $width = 0;
        });


        function fullScreenIcon() {
            $fullScreenIcon.toggleClass($fullScrIconClass, $fullScrIconPress);
        }

        function asideRightPanel() {
            $asideRightPanel
                .css('background-color', 'transparent')
                .toggleClass('absolutepanel')
                .css('right', 'inherit!important')
                .unbind('click');
        }

    })(jQuery);
}
