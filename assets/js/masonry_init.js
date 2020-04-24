import Masonry from 'masonry-layout';

let grid = document.querySelector('#masonry-grid');

if (grid !== undefined){
        let masonry = new Masonry('#masonry-grid', {
            // options...
            itemSelector: '.masonry-brick',
        });
}
