import jQuery from 'jquery';
import Cookies from 'js-cookie';
import Masonry from 'masonry-layout';

let assets = document.querySelector('#tools');
if (assets != null) {
    (function ($, undefined) {

        let $col1 = $('#col1:first').filter('button');
        let $col2 = $('#col2:first').filter('button');
        let $col3 = $('#col3:first').filter('button');
        let $col4 = $('#col4:first').filter('button');
        let $masonryBrick = $('.masonry-brick').filter('div');
        let $masonryGrid = $('#masonry-grid:first').filter('div');
        if ($masonryGrid.length !== 0) {
            var $masonry = new Masonry('#masonry-grid', {
                // options...
                itemSelector: '.masonry-brick',
            });

            let $cookie = Cookies.get('cookie_cols');
            $masonryBrick.css('width', $cookie);
            $masonry.layout();
        }

        $col1.click(function () {
            $masonryBrick.removeClass('col-md-3').css('width', '100%');
            masonryLayout();

            Cookies.set('cookie_cols', '100%');
            return false;
        });

        $col2.click(function () {
            $masonryBrick.removeClass('col-md-3').css('width', '48%');
            masonryLayout();

            Cookies.set('cookie_cols', '48%');
            return false;
        });

        $col3.click(function () {
            $masonryBrick.removeClass('col-md-3').css('width', '33%');
            Cookies.set('cookie_cols', '33%');
            masonryLayout();
            return false;
        });

        $col4.click(function () {
            $masonryBrick.css('width', '23%');
            masonryLayout();
            Cookies.set('cookie_cols', '23%');
            return false;
        });

        function masonryLayout() {
            if ($masonryGrid.length !== 0) {
                $masonry.layout();
            }
        }
    })(jQuery);
}
