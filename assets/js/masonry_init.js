var $ = require('jquery');
var jQueryBridget = require('jquery-bridget');
var Masonry = require('masonry-layout');
// make Masonry a jQuery plugin
jQueryBridget( 'masonry', Masonry, $ );
// now you can use $().masonry()
$('.grid').masonry({
    columnWidth: 80
});