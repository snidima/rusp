



<!-- TAB NAVIGATION -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Задасть вопрос</a></li>
    <li><a href="#tab2" role="tab" data-toggle="tab">Активные переписки</a></li>
</ul>
<!-- TAB CONTENT -->
<div class="tab-content">
    <div class="active tab-pane fade in" id="tab1">
        <h2>Отрапвка сообщения</h2>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Внимание!</h3>
            </div>
            <div class="panel-body">
                <p>Если вы хотитие отправить сообщение об ошибке в прогнозе, делайте это через стандартную форму на странице рассылки.</p>
                <a href="#">Узнать как</a>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Запрос в службу поддержки</h3>
            </div>
            <div class="panel-body">


                <form action="" method="" role="form" class="form-horizontal">
                    <div class="form-group">
                        <label for="mail" class="col-sm-4 control-label">Ваш логин</label>
                        <div class="col-sm-8">
                            <p class="help-block"><b><?=$user['nickname']?></b></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mail" class="col-sm-4 control-label">E-mail</label>
                        <div class="col-sm-8">
                            <p class="help-block"><b><?=$user['email']?></b></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="theme" class="col-sm-4 control-label">Платежная система</label>
                        <div class="col-sm-8 text-left">
                            <select class="form-control" id="theme">
                                <option>Технический вопрос</option>
                                <option>Нетехнический вопрос</option>
                                <option>Глупый вопрос</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class="col-sm-4 control-label">Сообщение</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" rows="3" id="text"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text" class="col-sm-4 control-label">Код проверки</label>
                        <div class="col-lg-8">
                            <p class="help-block">
                            <div class="g-recaptcha" id="recaptcha1" data-sitekey="6LeP4w0TAAAAAKSkMgx_7TRsIeXrz5uzMqOsjBox"></div>
                            </p>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" class="pull-right">Отправить вопрос</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab2">
        <h2>Tab2</h2>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>Дата</th>
                <th>Тема</th>
                <th>Запрос</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1234</td>
                <td>3 марта 2015, 02:00</td>
                <td>Глупый вопрос</td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit..</td>
                <td><a href="#">Перейти</a></td>
            </tr>
            </tbody>
        </table>

    </div>

</div>
