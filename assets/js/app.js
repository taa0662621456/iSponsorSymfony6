// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('../css/app.css');

require('./bootstrap-tags-input-init.js');
require('./cart.js');
require('../../templates/bootstrap-4.0.0/js/src/carousel.js');
require('./dropzone');
require('./js.cookie');
require('./tinymce_init');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// MultiStepForms init by https://codepen.io/designify-me/pen/qrJWpG
import('./multistep_forms.js');

//Move to top
import('./move_up.js');

// Bootstrap AutoHidingNavbar
import('./auto_hiding_navbar_init.js');

//cols adapter
import('./grid_cols_adapter.js');

//Full-screen size adapter
import('./full_screen_adapter.js');


