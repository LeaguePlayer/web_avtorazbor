<!-- <div class="page">
	<h1 class="head">
		<?=$model->model->car_brand->name?> <?=$model->model->name?>
	</h1>

	<div class="wr">

		<div class="coll left">
			<div class="content">
    			<div class="image">
	    			<a href="<?= ($model->img_preview ? $model->getImageUrl() : '/media/images/usedcars/default.jpg' ) ?>">
						<img src="<?= ($model->img_preview ? $model->getImageUrl('medium') : '/media/images/usedcars/default.jpg' ) ?>" alt="" title=""/>
					</a>
				</div>
				<div class="info">
					<p><span>Марка: </span><a href="/catalog/?brand=<?=$model->model->car_brand->name?>"><?=$model->model->car_brand->name?></a></p>
					<p><span>Пробег: </span><?=$model->dop->mileage?></p>
					<p><span>Состояние: </span><?=$model->dop->getState()?></p>
					<p><span>Объем двигателя: </span><?=$model->force?></p>
					<p><span>Коробка передач: </span><?=$model->dop->getTransmissionType()?></p>
					<p><span>Тип кузова: </span><?=$model->bascet?></p>
					<p><span>Цена: </span><?=$model->price?></p>
					<a href="#own-price" class="own-price"><span>Предложить свою цену</span></a>
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
-->
<div class="page">
            <h1 class="head">
                <?=$model->name?>
            </h1>

            <div class="wr">

                <!-- <div class="coll-left">
                    
                </div> -->

                <div class="coll-right" style="float:left;width:100%;">

                    <div class="content clear">

                        <div class="gallery">
                            <div class="big-img">
                                <a class="imgFancy" href="<?=$model->getImageUrl('big') ? $model->getImageUrl('big') : '/media/images/default.png' ?>"><img width="331" height="192" src="<?=$model->getImageUrl('mormal') ? $model->getImageUrl('mormal') : '/media/images/default.png' ?>" alt="" title="" />
                            </div>
                        </div>

                        <div class="desc">

                            <ul>
                            <li>Марка: <a href="/catalog/?brand=<?=$model->model->car_brand->name?>"><?=$model->model->car_brand->name?></a></li>
							<li>Пробег: <?=$model->dop->mileage?></li>
							<li>Состояние: <?=$model->dop->getState()?></li>
							<li>Объем двигателя: <?=$model->force?></li>
							<li>Коробка передач: <?=$model->dop->getTransmissionType()?></li>
							<li>Тип кузова: <?=$model->bascet?></li>
							<li>Цена: <?=number_format($model->price,0,' ',' ') ?> руб.</li>
							<li><a href="#own-price" class="own-price"><span>Предложить свою цену</span></a></li>
                            </ul>
                            <div class="submit">
                                <input  type="submit" value="В корзину" class="i-submit inCart" />
                            </div>

                        </div>

                        <div class="shared clear">
                            <dl>
                                <dt>
                                    Поделиться:
                                </dt>
                                <dd>
                               <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_sharing_toolbox"></div>
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53df85bc15a98471"></script>
                                </dd>
                            </dl>
                        </div>

                        <div class="readmore">
                            <a href="/detail/parts?<?=Yii::app()->session->get("backToResultUrl");?>">
                                Вернуться к результатам поиска
                            </a>
                        </div>

                        <div class="clear"></div>

                    </div>

                    

                </div>


                <div class="clear"></div>
            </div>
        </div>  
<?=$this->renderPartial('//forms/ownPrice',array('model'=>new Ownprice),true);?>