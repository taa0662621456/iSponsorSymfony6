import jQuery from 'jquery';

(function ($, undefined) {
    let $col1 = $('input#col1');
    let $col2 = $('input#col2');
    let $col3 = $('input#col3');
    let $col4 = $('input#col4');
    let $masonryBrick = $('div.masonry-brick');
    let $masonryGrid = $('div.masonry-grid');
    let $cookie = $.cookie('cookie_cols');

    if ($cookie === 'undefined') {

    } else {
        $masonryBrick.css('width', $cookie);
        msnry.layout();
        console.log($cookie);
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
        $masonryGrid.Masonry('layout');
        $.cookie('cookie_cols', '100%');
    });

    $col2.click(function () {
        //let cookie_cols = $.cookie('cookie_cols');
        //$('.spacer').css('text-align', 'left');
        //$('.spacer').css('padding', '0px 10px');
        //$('.browse').css('margin', '4px');
        //$('.category-vendor-avatar').css('height', '100px');
        //$('.category-vendor-avatar').css('width', '100px');
        //$('div.addtocart-bar').removeClass('hidden-xs');
        //$('form.formfavorit').removeClass('hidden-xs');
        $masonryBrick.css('width', '48%');
        $masonryGrid.Masonry('layout');
        $.cookie('cookie_cols', '48%');
    });

    $col3.click(function () {
        //let cookie_cols = $.cookie('cookie_cols');
        //$('.spacer').css('text-align', 'left');
        //$('.spacer').css('padding', '0px 10px');
        //$('.browse').css('margin', '3px');
        $masonryBrick.css('width', '33%');
        $masonryGrid.Masonry('layout');
        $.cookie('cookie_cols', '33%');
    });

    $col4.click(function () {
        //let cookie_cols = $.cookie('cookie_cols');
        //$('.spacer').css('text-align', 'center');
        //$('.spacer').css('padding', '0');
        //$('.browse').css('margin', '2px');
        $masonryBrick.css('width', '23%');
        $masonryGrid.Masonry('layout');
        $.cookie('cookie_cols', '23%');
    });
})(jQuery);
