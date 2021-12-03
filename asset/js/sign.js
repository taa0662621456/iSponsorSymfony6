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
    let forms = document.querySelectorAll('.needs-validation')

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


    // app.post('/sendSMS', function (req, res) {
    //     const {phoneNumber, recaptchaToken} = req.body;
    //
    //     const identityToolkit = google.identitytoolkit({
    //         auth: 'GCP_API_KEY',
    //         version: 'v3',
    //     });
    //
    //     identityToolkit.relyingparty.verifyPhoneNumber({
    //         code: verificationCode,
    //         sessionInfo: phoneSessionId,
    //     });
    //
    //     // verification code accepted, update phoneNumberVerified flag in database
    //     // ...
    // });
