import '../stimulus_bridge_init'
import 'bootstrap/dist/js/bootstrap.bundle.min'
import 'bootstrap/js/dist/popover'
import { Toast } from 'bootstrap/dist/js/bootstrap.esm.min'

//require('bootstrap');
//require('bootstrap-autohide-navbar');


//require('masonry-layout');
require('../scss/base.scss');
require('../css/base.css');


//import('./masonry_init.js');
//import('../css/app.css');
import('../css/navbar.css');

//require('./dropdown-toggle_init'); //TODO: использует jQuery; необходимо альтернативное решение
//require('../css/likeMasonryCart.css');
require('../fontawesome-pro/js/all.min');
require('./auto_hiding_navbar_init');
// require('./bootstrap-tags-input-init');
// require('./cart.js');
//require('./multistep_form'); //TODO: использует jQuery; помечено на удаление
//require('./tinymce_init');
require('./move_up');
//require('./masonry_init');
// require('./cols_per_row');
// require('./add-collection-widget');
require('./full_screen')
require('./form_links_add_and_rem')


Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode).show());
