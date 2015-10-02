<div class="mainArea">
    <h3>Регистрация Покупателя</h3>

    <?
   // print_r(form_error());
    @$errors = validation_errors();
    if(@$wrongCaptcha)
        $errors .= 'Похоже, что вы робот';
    if(!@empty($errors)){
        ?>
        <div class="alert alert-danger  mtop20">
            <?=$errors?>
        </div>
    <?
    }

   ?>

    <div class="col-md-8">
    <form method="post" id="signupForm">
        <div class="mtop20 form-group">
            <input type="email" name="email" placeholder="Email" class="form-control" title="Введите сюда свой email" required>

        </div>
        <div class="mtop10 form-group">
            <input type="text" name="nickname" placeholder="Ник" class="form-control" title="Запрещено использование email, оскорблений, мата и спама." required>
        </div>
        <div class="mtop10 form-group">
            <input type="password" name="pwd" placeholder="Пароль" class="form-control" title="Пароль должен содержать от 6 до 20 символов"  required>
        </div>
        <div class="mtop10 form-group">
            <input type="password" name="pwd2" placeholder="Повтор Пароля" title="Повтор Пароля должен совпадать с паролем" class="form-control" required>
        </div>
        <div class="mtop10 form-group">
            <div class="g-recaptcha" id="recaptcha1" data-sitekey="6Lc_UQ0TAAAAANLH0Y1aLdFyz19V-Jji_U-Kh2JI"></div>
        </div>
        <div class="mtop10 form-group">
            <input type="checkbox" name="tos_agreed" value="1" checked required> С <a href="#">правилами системы</a> согласен
        </div>

        <div class="mtop10">
            <button class="btn dblue" type="submit">Регистрация</button>
        </div>
    </form>
    </div>
    <div class="clearfix"></div>
</div>

<script>
    $(document).ready(function(){
        $('#signupForm input').each(function(){

            $(this).attr('data-toggle', 'tooltip');
            $(this).attr('data-placement', 'right');
            $(this).attr('data-trigger', 'focus');
            $(this).tooltip();
        });
        //$('#signupForm').bootstrapValidator();

        $('#signupForm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email : {
                    threshold: 5,
                    validators: {
                        regexp: {
                            regexp: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i,
                            message: 'Неверный формат email адреса'
                        },
                        remote: {
                            url: '/user/checkEmail/',
                            type: 'POST',
                            message: "Данный email уже зарегистрирован"

                        }
                    }

                },

                pwd: {
                    validators: {
                        notEmpty: {
                            message: 'Пароль не может быть пустой'
                        },
                        different: {
                            field: 'username',
                            message: 'Пароль не может совпадать с Ником'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Пароль должен быть от 6 до 20 символов'
                        }
                    }
                },
                nickname: {
                    threshold: 3,
                    validators: {
                        stringLength: {
                            min: 4,
                            max: 15
                        },
                        remote: {
                            url: '/user/checkNickname/',
                            type: 'POST',
                            message: "Данный ник уже зарегистрирован либо содержит запрещенные символы или слова"
                        }
                    }
                },
                pwd2: {
                    validators: {
                        notEmpty: {
                        },
                        identical: {
                            field: 'pwd'
                        }
                    }
                }
            }
        });

    });


</script>