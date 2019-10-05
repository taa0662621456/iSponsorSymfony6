// jQuery (must be first - before all .js)
// Installed with "yarn add jquery"
const $ = require('jquery');

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('../css/app.css');

require('./bootstrap-tags-input-init');
require('../../templates/bootstrap-4.0.0/js/src/carousel');
require('bootstrap-autohide-navbar');
require('bootstrap-confirmation2');

//Cookie (must before the cart.js
require('./js.cookie.js');

// Cart
require('./cart.js');

require('./dropzone');

//TinyMce
require('./tinymce_init');
//Masonry
require('./masonry_init');
// MultiStepForms init by https://codepen.io/designify-me/pen/qrJWpG
require('./multistep_forms');
//Move to top
require('./move_up');
// Bootstrap AutoHidingNavbar
require('./auto_hiding_navbar_init');
//cols adapter
require('./grid_cols_adapter');
//Full-screen size adapter
require('./full_screen_adapter');


