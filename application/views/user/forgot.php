<div class="mainArea">
    <h3>Восстановление пароля</h3>

    <? if(@$notRegistered){
        ?>
        <div class="alert alert-danger mtop20">
            Данный email не зарегистрирован
        </div>
    <?
    }?>

    <div class="mtop30">
        <form method="post" id="recoveryForm">
            <div class="form-group">
                <input name="email" type="email" required placeholder="Введите Ваш Email" class="form-control">
            </div>
            <div class="mtop10">
                <button class="btn dblue" type="submit">Восстановить пароль</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        //$('#signupForm').bootstrapValidator();

        $('#recoveryForm').bootstrapValidator({
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
                        }
                    }

                }
            }
        });

    });


</script>