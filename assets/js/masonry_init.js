let grid = document.querySelector('#masonry-grid');

if (grid != undefined){
    let msnry = new Masonry( '#masonry-grid', {
        // options...
        itemSelector: '.masonry-brick',
    });
}
