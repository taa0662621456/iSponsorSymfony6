import 'bootstrap'
import { Toast } from 'bootstrap/dist/js/bootstrap.esm.min.js'

require('../scss/sign.scss')
require('../css/sign.css')

require('../../templates/bootstrap-4.0.0/docs/4.0/examples/sign-in/signin.css')
Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode).show());
