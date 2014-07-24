<div class="page">
	<h1 class="head">
		<?=$model->model->car_brand->name?> <?=$model->model->name?>

	</h1>

	<div class="wr">

		<div class="coll left">
			<div class="content">
    			<div class="image">
				<img src="<?= ($model->getImageUrl()!=null ? $model->getImageUrl() : '/media/images/usedcars/default.jpg' ) ?>" width="400" height="267" alt="" title=""/>
				</div>
				<div class="info">
					<p><span>Марка: </span><a href="/catalog/?brand=<?=$model->model->car_brand->name?>"><?=$model->model->car_brand->name?></a></p>
					<p><span>Пробег: </span><?=$model->dop->mileage?></p>
					<p><span>Состояние: </span><?=$model->dop->getState()?></p>
					<p><span>Объем двигателя: </span><?=$model->force?></p>
					<p><span>Коробка передач: </span><?=$model->dop->getTransmissionType()?></p>
					<p><span>Тип кузова: </span><?=$model->bascet?></p>
					<p><span>Цена: </span><?=$model->price?></p>
					<a href="#" class="own-price"><span>Предложить свою цену</span></a>
				</div>
				<div class="comment">
				<p class="comment">Коментарий:</p><?=$model->comment?>
				</div>
			</div>
		</div>

		<div class="coll right">
            <div class="modul first">

                    <p class="phone">+7 (343) 201-36-06</p>
                    <a href="#">
                        Услуги автоэвакуатора
                    </a>
            </div>
            <div class="modul second">
                    
                    <p class="question">Есть вопросы?<br>
                        <span>Напиши нам</span>
                    </p>
                    <a href="#">
                        Услуги автоэвакуатора
                    </a>
            </div>
        </div>  

		<div class="clear"></div>
	</div>
</div>