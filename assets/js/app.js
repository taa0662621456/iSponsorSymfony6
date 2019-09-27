// jQuery (must be first - before all .js)
// Installed with "yarn add jquery"
const $ = require('jquery');

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('../css/app.css');

require('./bootstrap-tags-input-init.js');
require('../../templates/bootstrap-4.0.0/js/src/carousel.js');
require('~bootstrap-confirmation');

//Cookie (must before the cart.js
require('./js.cookie.js');

// Cart
require('./cart.js');

require('./dropzone');

//TinyMce
require('./tinymce_init');


// MultiStepForms init
// by https://codepen.io/designify-me/pen/qrJWpG
import('./multistep_forms.js');

//Move to top
import('./move_up.js');

// Bootstrap AutoHidingNavbar
import('./auto_hiding_navbar_init.js');

//cols adapter
import('./grid_cols_adapter.js');

//Full-screen size adapter
import('./full_screen_adapter.js');


