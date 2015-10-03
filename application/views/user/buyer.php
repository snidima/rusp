<div class="panel panel-default">
	<div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                <img src="http://placehold.it/100x100" class="img-rounded img-responsive">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h4><b><?=$user['nickname']?> | <?=$info['delivery']?></b></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, cupiditate?
                    <a href="#" type="button" data-toggle="modal" data-target=".bs-example-modal-lg">Полное описание</a>
                </p>
            </div>

        </div>
        <hr>
        <h5>
             <p><b><i class="fa fa-line-chart"></i> Активных месяцев на бирже:</b> <?=rand(1,20)?> </p>
             <p><b><i class="fa fa-futbol-o"></i> Профильный вид спорта:</b> "Общий" <br></p>
             <p><b><i class="fa fa-calendar"></i> Фиксированное время рассылки:</b> <br></p>
             <p><b><i class="fa fa-star"></i> Дабвлений в избранное:</b> 10</p>
        </h5>
        <hr>
        <ul class="nav nav-pills">
            <li class="active"><a href="#">Стастистика</a></li>
            <li><a href="#">Отзывы</a></li>
            <li><a href="#">Результаты</a></li>
            <li><a href="#">Купить</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Еще.. <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
        </ul>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><b><?=$user['nickname']?> | <?=$info['delivery']?></b></h4>
            </div>
            <div class="modal-body">
               <p>
                   <?=$info['description']?>
               </p>
            </div>
        </div>
    </div>
</div>
