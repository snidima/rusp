<div class="panel panel-default">
	<div class="panel-body">


        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Баланс</a></li>
            <li><a href="#tab2" role="tab" data-toggle="tab">Вывод средств </a></li>
        </ul>
        <!-- TAB CONTENT -->
        <div class="tab-content">
            <div class="active tab-pane fade in" id="tab1">
                <h2>Баланс</h2>
                <hr>
                <table class="table table-hover" id="more-container" data-num="1">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Источник</th>
                        <th>Доход/Вывод</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach($info as $i){ ?>
                        <tr>
                            <td><?=date('d.m.Y, G:H', $i['date'])?></td>
                            <td><?=$i['type']?></td>
                            <td><b><i class="fa fa-usd"></i> <?=$i['amount'];?></b></td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
                <? if ($nomore) {?>
                    <button type="button" class="btn btn-default pull-right" aria-label="Left Align" id="more">
                        Показать еще
                    </button>
                <? } ?>
            </div>
            <div class="tab-pane fade" id="tab2">
                <h2>Вывод средств</h2>
                <hr>

                <table class="table table-hover">
                	<thead>
                		<tr>
                			<th>№ запроса</th>
                			<th>Дата/Время</th>
                			<th>Реквизиты</th>
                			<th>Сумма</th>
                			<th>Статус</th>
                		</tr>
                	</thead>
                	<tbody>
                		<tr>
                			<td>1111</td>
                			<td>05.05.540</td>
                			<td>афцаф</td>
                			<td>500</td>
                			<td>в оработке</td>
                		</tr>
                        <tr>
                			<td>1111</td>
                			<td>05.05.540</td>
                			<td>афцаф</td>
                			<td>500</td>
                			<td>в оработке</td>
                		</tr>
                	</tbody>
                </table>




                <div class="alert alert-success" role="alert">
                    <p>Ваше текущий баласн: <b><i class="fa fa-usd"></i> 5.50</b></p>
                </div>

                <form action="" method="" role="form" class="form-horizontal">
                	<legend>Форма заказа выплаты</legend>

                    <div class="form-group">

                            <label for="paysystem" class="col-sm-4 control-label">Платежная система</label>
                            <div class="col-sm-8 text-left">
                                <select class="form-control" id="paysystem">
                                    <option>WebMoney</option>
                                </select>
                            </div>

                    </div>

                    <div class="form-group">
                        <label for="WMID" class="col-sm-4 control-label">WMID</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="WMID" placeholder="WMID..">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mail" class="col-sm-4 control-label">WMZ</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="mail" placeholder="WMZ..">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mail" class="col-sm-4 control-label">Сумма выплаты, USD</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="mail" placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text" class="col-sm-4 control-label">Примечание<br><small class="text-muted">(необязательно)</small></label>
                        <div class="col-lg-8">
                            <textarea class="form-control" rows="3" id="text"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text" class="col-sm-4 control-label">Примечание</label>
                        <div class="col-lg-8">
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Запомнить реквизиты</label>
                            </div>
                        </div>
                    </div>

                
                	<button type="submit" class="btn btn-primary" class="pull-right">Отправить заказ выплаты</button>
                </form>

            </div>
        </div>




	</div>
</div>






