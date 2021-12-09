import 'bootstrap'
import { Toast } from 'bootstrap/dist/js/bootstrap.esm.min.js'
import IMask from 'imask';

require('../scss/sign.scss')
require('../css/sign.css')
require('../../templates/bootstrap-5.1.3/sign-in/signin.css')

/**
 * Password validation
 */

if (document.querySelectorAll('input[type="password"]').length > 1) {

    let submit = document.querySelector('button[type="submit"]')
    submit.classList.add('disabled')
    let passwordFirst = document.getElementById('vendor_registration_vendorSecurity_plainPassword_first')
    let passwordSecond = document.getElementById('vendor_registration_vendorSecurity_plainPassword_second')

    passwordFirst.addEventListener('input', plainValidation)
    passwordSecond.addEventListener('input', plainValidation)

    function plainValidation(){
        if (passwordFirst.value !== passwordSecond.value) {
            submit.classList.add('disabled')
            passwordFirst.classList.remove('is-valid')
            passwordFirst.classList.add('is-invalid')
            passwordSecond.classList.remove('is-valid')
            passwordSecond.classList.add('is-invalid')

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)

        } else {
            let submit = document.querySelector('button[type="submit"]')
            passwordFirst.classList.remove('is-invalid')
            passwordFirst.classList.add('is-valid')
            passwordSecond.classList.remove('is-invalid')
            passwordSecond.classList.add('is-valid')
            submit.classList.remove('disabled')
        }
    }
}
/**
 * Toast init
 */
Array.from(document.querySelectorAll('.toast'))
    .forEach(toastNode => new Toast(toastNode).show());
/**
 * Bootstrap validation
 */
let forms = document.querySelectorAll('.needs-validation')
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
/**
 * IMask pattern
 */
const vendorSecurity_phone = document.getElementById('vendor_registration_vendorSecurity_phone');
const maskOptions = {
    mask: '+00000000000[0000]',
    overwrite: true,
};
const mask = IMask(vendorSecurity_phone, maskOptions);


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
