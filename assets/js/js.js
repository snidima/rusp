var recaptcha2, recaptcha1;

var onloadCallback = function() {
    if($('#recaptcha2').length > 0){
        recaptcha2 = grecaptcha.render('recaptcha2', {
            'sitekey' : '6Lc_UQ0TAAAAANLH0Y1aLdFyz19V-Jji_U-Kh2JI',
            'theme' : 'light'
        });
    }

    if($('#recaptcha1').length > 0){
        recaptcha1 = grecaptcha.render('recaptcha1', {
            'sitekey' : '6Lc_UQ0TAAAAANLH0Y1aLdFyz19V-Jji_U-Kh2JI',
            'theme' : 'light'
        });
    }
};

$(document).ready(function(){


    $('#loginBtn').click(function(){
        $.ajax({
            type: "POST",
            url: '/user/login',
            data: $('#loginForm').serialize(),
            success: function(data){
                console.log(data);
                if(data == -1 || data == 1)
                    window.location = location.href;
                if(data == 0 || data == -2)
                    $('#loginNotification').html('<div class="alert alert-danger mtop10"> Неверный логин/пароль </div>');
                if(data == -2 || data == -3)
                    $('#loginCaptcha').show();
                if( data == -3)
                    $('#loginNotification').html('<div class="alert alert-danger mtop10"> Вы не прошли проверку на робота </div>');

                grecaptcha.reset(recaptcha2);
            }
        });
    });
});