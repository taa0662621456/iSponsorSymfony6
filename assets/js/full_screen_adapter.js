import jQuery from 'jquery';
import Cookies from 'js-cookie';
//import Masonry from 'masonry-layout';

let fullScreenButton = document.querySelector('#full-screen');

if (fullScreenButton != undefined ) {

    (function ($, undefined) {

        let $hideArray = $('#b1, #b2, #header'); // elements for hiding in full-screen
        let $contentBlock = $('#b3').filter('div'); // col with main content
        let $asideRightPanel = $('#b4').filter('div');
        let $fullScreenButton = $('#full-screen').filter('button');
        let $fullScreenMessage = $('#fullscreen-message').filter('div');
        let $fullScreenIcon = $('.fa-arrows-alt').filter('i');
        let $fullScrIconClass = 'fad fa-arrows-alt';
        let $fullScrIconPress = 'fad fa-compress-arrows-alt';

        let $masonryLayout = $('.view').filter('div');

        let $display = function () {
            Math.round(100 * $contentBlock.width() / $contentBlock.parent().width())
        };

        if (Cookies.get('screen')) {
            let $screen = Cookies.get('screen');
        } else {
            let $screen;
        }

        $fullScreenButton.click(function () {

            if ($display === '100') {

                $fullScreenMessage
                    .toggleClass('hidden')
                    .animate({opacity: 0.25, top: "-50", height: "toggle"}, 5000);

                $hideArray.hide();
                $contentBlock.css('width', '100%');

                $asideRightPanel
                    .toggleClass('absolutepanel')
                    .toggle(function () {
                        $asideRightPanel.animate({right: '-165px'}, 500);
                    }, function () {
                        $asideRightPanel.animate({right: 0}, 500);
                    });

                fullScreenIcon();
            } else {

                $contentBlock.css('width', '');
                $hideArray.show();

                $asideRightPanel
                    .css('background-color', 'transparent')
                    .toggleClass('absolutepanel')
                    .css('right', 'inherit!important')
                    .unbind('click');

                fullScreenIcon();
            }

            $masonryLayout.masonry('layout');

        });

        $('html').keypress(function (e) {

            if (e.keyCode === 27 && $display === '100') {
                $fullScreenMessage.toggleClass('hidden');

                $hideArray.show();
                $contentBlock.css('width', '');

                asideRightPanel();
                fullScreenIcon();

                $masonryLayout.masonry('layout');
            }
        });


        function fullScreenIcon($fullScrIconClass, $fullScrIconPress) {
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
