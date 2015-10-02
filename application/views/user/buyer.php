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
        <h5><b>Активных месяцев на бирже:</b> <?=rand(1,20)?></h5>
        <hr>
        <h5><b>Профильный вид спорта:</b> "Общий"</h5>
        <hr>
        <h5><b>Фиксированное время рассылки:</b> ?</h5>
        <hr>
        <h5><b>Дабвлений в избранное:</b> 10</h5>
	</div>
</div>

<?php

//var_dump($info) ;



?>

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
