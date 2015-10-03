var recaptcha2, recaptcha1;

var onloadCallback = function() {
    if($('#recaptcha2').length > 0){
        recaptcha2 = grecaptcha.render('recaptcha2', {
            'sitekey' : '6LeP4w0TAAAAAKSkMgx_7TRsIeXrz5uzMqOsjBox',
            'theme' : 'light'
        });
    }

    if($('#recaptcha1').length > 0){
        recaptcha1 = grecaptcha.render('recaptcha1', {
            'sitekey' : '6LeP4w0TAAAAAKSkMgx_7TRsIeXrz5uzMqOsjBox',
            'theme' : 'light'
        });
    }
};

$(document).ready(function() {

    $('[data-toggle="popover"]').popover();

    $('#loginBtn').click(function () {
        $.ajax({
            type: "POST",
            url: '/user/login',
            data: $('#loginForm').serialize(),
            success: function (data) {
                console.log(data);
                if (data == -1 || data == 1)
                    window.location = location.href;
                if (data == 0 || data == -2)
                    $('#loginNotification').html('<div class="alert alert-danger mtop10"> Неверный логин/пароль </div>');
                if (data == -2 || data == -3)
                    $('#loginCaptcha').show();
                if (data == -3)
                    $('#loginNotification').html('<div class="alert alert-danger mtop10"> Вы не прошли проверку на робота </div>');

                grecaptcha.reset(recaptcha2);
            }
        });
    });

    $("#more").click(function () {
        var page  = $("#more-container").attr('data-num');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/user/more",
            data: "page=" + page,
            success: function (data) {
                $("#more-container>tbody").append(data['html']);
                $("#more-container").attr('data-num', page * 1 + 1);
                if (data['stop']) $("#more").hide();
            }
        });
    });

});