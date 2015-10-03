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
                    <div class="g-recaptcha"  id="recaptcha2" data-sitekey="6LeP4w0TAAAAAKSkMgx_7TRsIeXrz5uzMqOsjBox"  style="width: 100%;overflow:hidden;border-right:1px solid #ccc" data-size="200"></div>
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

            <!--<div class="mtop10">
                Вы авторизованы как <?/*=$user['nickname']*/?><br>(<?/*=$user['email']*/?>)<br>
                Вы <?/* if($user['usertype'] == 'buyer') echo 'Покупатель';else echo "Каппер"*/?><br>
                <a href="/user/logout">Выйти</a>
            </div>-->


            <div class="list-group menu-kapper">
                <span href="#" class="list-group-item">
                    <a href="/user/buyer/<?=$user['nickname']?>">
                        <img src="http://placehold.it/50x50" class="img-rounded">
                        <b><?=$user['nickname']?></b>
                    </a>
                </span>
                <a href="/user/buyer/<?=$user['nickname']?>" class="list-group-item">
<!--                    <span class="badge">14</span>-->
                    <i class="fa fa-home"></i> Моя страница
                </a>
                <a href="/user/balance" class="list-group-item">
                    <span class="badge">
                        <i class="fa fa-usd"></i> 57.5
                    </span>
                    <i class="fa fa-credit-card"></i> Баланс
                </a>
                <a href="#" class="list-group-item disabled">
<!--                    <span class="badge">1</span>-->
                    <i class="fa fa-money"></i> Продажи
                </a>
                <a href="#" class="list-group-item disabled">
<!--                    <span class="badge">1</span>-->
                    <i class="fa fa-archive"></i> Архив
                </a>
                <a href="#" class="list-group-item disabled">
<!--                    <span class="badge">1</span>-->
                    <i class="fa fa-cog"></i> Настройки
                </a>
                <a href="/user/supportsend" class="list-group-item">
<!--                    <span class="badge">1</span>-->
                    <span class="badge">1 ответ</span>
                    <i class="fa fa-comments"></i> Служба поддержки
                </a>
                <a href="#" class="list-group-item disabled">
                    <span class="badge">2</span>
                    <i class="fa fa-volume-up"></i> Уведомления
                </a>
                <a href="#" class="list-group-item disabled">
<!--                    <span class="badge">1</span>-->
                    <i class="fa fa-plus-square"></i> Добавить прогноз
                </a>
                <a href="#" class="list-group-item disabled">
<!--                    <span class="badge">1</span>-->
                    <i class="fa fa-pencil-square"></i> Написать в блог
                </a>
                <span class="list-group-item">
                    <a href="/user/logout" class="btn btn-danger">Выйти</a>
                </span>
            </div>


        <?
        }?>
    </div>
</form>

<? if(@empty($user)){ ?>
<a class="regLink" href="/user/signUpBuyer">
    <i class="fa fa-plus"></i> РЕГИСТРАЦИЯ (покупателя)
</a>
<a class="regLink" href="/user/signUpSeller">
    <i class="fa fa-plus"></i> РЕГИСТРАЦИЯ (каппера)
</a>
<? } ?>