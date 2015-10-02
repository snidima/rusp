<div class="mainArea">
    <h3>Восстановление пароля</h3>


    <div class="mtop30">
        Установите ваш новый пароль.
    </div>
    <div class="mtop10">
        <form method="post" id="newPwdForm">
            <div class="form-group">
                <input name="pwd" type="password" required placeholder="Новый пароль" class="form-control">
            </div>
            <div class="form-group">
                <input name="pwd2" type="password" required placeholder="Повтор нового пароля" class="form-control">
            </div>
            <div class="mtop10">
                <button class="btn dblue" type="submit">Сменить пароль</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        //$('#signupForm').bootstrapValidator();

        $('#newPwdForm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                pwd: {
                    validators: {
                        notEmpty: {
                            message: 'Пароль не может быть пустой'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Пароль должен быть от 6 до 20 символов'
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