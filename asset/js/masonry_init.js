import Masonry from 'masonry-layout';

function () {
    let $masonryGrid = $('#masonry-grid:first').filter('div');
    if ($masonryGrid.length !== 0) {
        var $masonry = new Masonry('#masonry-grid', {
            // options...
            itemSelector: '.masonry-brick',
        });
        $masonry.layout();
    }
}
