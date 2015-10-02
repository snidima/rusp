<div class="mainArea">
<? if(!@empty($user)){
    ?>
    Вы авторизованы как <?=$user['nickname']?> (<?=$user['email']?>)
    <a href="/user/logout">Выйти</a>
<?
}else {
    ?>
    Вы НЕ авторизованы.
<?
}?>
</div>