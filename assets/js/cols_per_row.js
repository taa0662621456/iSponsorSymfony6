import jQuery from 'jquery';
import Cookies from 'js-cookie';
import Masonry from 'masonry-layout';

let grid = document.querySelector('#masonry-grid');

if (grid !== undefined ) {

    (function ($, undefined) {

        let $col1 = $('#col1').filter('button');
        let $col2 = $('#col2').filter('button');
        let $col3 = $('#col3').filter('button');
        let $col4 = $('#col4').filter('button');
        let $masonryBrick = $('.masonry-brick').filter('div');
        let $masonryGrid = $('.masonry-grid').filter('div');
        let $masonry = new Masonry( '#masonry-grid', {
            // options...
            itemSelector: '.masonry-brick',
        });

        if (Cookies.get('cookie_cols')) {
            let $cookie = Cookies.get('cookie_cols');
            $masonryBrick.css('width', $cookie);
            $masonry.layout();
        }

        $col1.click(function () {
            //$('.spacer').css('text-align', 'left');
            //$('.spacer').css('padding', '0px 10px');
            //$('.masonry-browse').css('margin', '5');
            //$('.category-vendor-avatar').css('height', '160px');
            //$('.category-vendor-avatar').css('width', '160px');
            //$('div.addtocart-bar').removeClass('hidden-xs');
            //$('form.formfavorit').removeClass('hidden-xs');
            $masonryBrick.css('width', '100%');
            $masonry.layout();
            Cookies.set('cookie_cols', '100%');
            return false;
        });

        $col2.click(function () {
            //let cookie_cols = Cookies.set('cookie_cols');
            //$('.spacer').css('text-align', 'left');
            //$('.spacer').css('padding', '0px 10px');
            //$('.browse').css('margin', '4px');
            //$('.category-vendor-avatar').css('height', '100px');
            //$('.category-vendor-avatar').css('width', '100px');
            //$('div.addtocart-bar').removeClass('hidden-xs');
            //$('form.formfavorit').removeClass('hidden-xs');
            $masonryBrick.css('width', '48%');
            $masonry.layout();
            Cookies.set('cookie_cols', '48%');
            return false;
        });

        $col3.click(function () {
            //let cookie_cols = Cookies.set('cookie_cols');
            //$('.spacer').css('text-align', 'left');
            //$('.spacer').css('padding', '0px 10px');
            //$('.browse').css('margin', '3px');
            $masonryBrick.css('width', '33%');
            Cookies.set('cookie_cols', '33%');
            $masonry.layout();
            return false;
        });

        $col4.click(function () {
            //let cookie_cols = Cookies.set('cookie_cols');
            //$('.spacer').css('text-align', 'center');
            //$('.spacer').css('padding', '0');
            //$('.browse').css('margin', '2px');
            $masonryBrick.css('width', '23%');
            $masonry.layout();
            Cookies.set('cookie_cols', '23%');
            return false;
        });
    })(jQuery);

}
