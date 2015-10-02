<div class="logo  text-center">
    LOGO
</div>

<a href="#" class="menuLink">
    Рейтинги
</a>

<a href="#" class="menuLink">
    Прогнозы
</a>

<form method="post" action="/user/login" id="loginForm">
    <div class="loginArea">
        <? if(@empty($user)){ ?>
        <div>
            Вход в Кабинет
        </div>
        <div id="loginNotification"></div>


        <div class="mtop10">
            <input type="text" name="username" class="form-control" placeholder="Логин">
        </div>
        <div class="mtop10">
            <input type="password" name="password" class="form-control" placeholder="Пароль">
        </div>


                <div class="mtop10" style="display:none" id="loginCaptcha">
                    <div class="g-recaptcha"  id="recaptcha2" data-sitekey="6Lc_UQ0TAAAAANLH0Y1aLdFyz19V-Jji_U-Kh2JI"  style="width: 100%;overflow:hidden;border-right:1px solid #ccc" data-size="200"></div>
                </div>

        <div class="mtop10 row">
            <div class="col-md-4">
                <button class="btn dblue" id="loginBtn" type="button">Войти</button>
            </div>
            <div class="col-md-8 text-right">
                <a href="/user/forgot">Восстановить пароль</a>
            </div>

        </div>
        <? }else {
            ?>
            <div class="mtop10">
                Вы авторизованы как <?=$user['nickname']?><br>(<?=$user['email']?>)<br>
                Вы <? if($user['usertype'] == 'buyer') echo 'Покупатель';else echo "Каппер"?><br>
                <a href="/user/logout">Выйти</a>
            </div>
        <?
        }?>
    </div>
</form>
<a class="regLink" href="/user/signUpBuyer">
    <i class="fa fa-plus"></i> РЕГИСТРАЦИЯ (покупателя)
</a>
<a class="regLink" href="/user/signUpSeller">
    <i class="fa fa-plus"></i> РЕГИСТРАЦИЯ (каппера)
</a>