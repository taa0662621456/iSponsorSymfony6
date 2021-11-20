import 'bootstrap'
import { Toast } from 'bootstrap/dist/js/bootstrap.esm.min.js'

require('../scss/sign.scss')
require('../css/sign.css')

require('../../templates/bootstrap-4.0.0/docs/4.0/examples/sign-in/signin.css')
Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode).show());


(function () {
    'use strict'

    // Получите все формы, к которым мы хотим применить пользовательские стили проверки Bootstrap
    var forms = document.querySelectorAll('.needs-validation')

    // Зацикливайтесь на них и предотвращайте отправку
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
