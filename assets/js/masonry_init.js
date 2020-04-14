let grid = document.querySelector('.masonry-grid');

if (grid != undefined){
    let msnry = new Masonry( '.grid', {
        // options...
        itemSelector: '.masonry-brick',
    });
}
