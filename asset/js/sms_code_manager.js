var jQuery = require('jquery');
(function ($, undefined) {
    let $submit = $('text-link').filter('input');
    let $phone = $('#app_user_registration_mobileNumber').val(); // считываем значение, если это форма регистрации

    $submit.on('click', function () {

        console.log($phone);
        $.ajax({
            url: '/smscodegenerator',
            type: 'POST',
            data: {mobileNumber: $phone},
            dataType: 'json',
        })
            .done(function (res) {
                console.log(res); // Здесь просто всё ок)
            })
            .fail(function () {
                console.log('Ошибка соединения с сервером');
            });
    });
})(jQuery);

