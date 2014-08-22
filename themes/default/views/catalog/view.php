<div class="page">
    <h1 class="head">
        <?=$model->name?>
    </h1>

    <div class="wr">

        <div class="coll left" >

            <div class="content clear">

                <div class="gallery">
                    <div class="big-img">
                        <a class="imgFancy" href="<?=$model->getImageUrl('big') ? $model->getImageUrl('big') : '/media/images/default.png' ?>"><img width="331" height="192" src="<?=$model->getImageUrl('mormal') ? $model->getImageUrl('mormal') : '/media/images/default.png' ?>" alt="" title="" /></a>
                    </div>
                </div>

                <div class="desc">

                    <ul>
                        <?
                            $param="?SearchFormOnMain[brand]=".$model->model->car_brand->id."&SearchFormOnMain[id_country]=".$model->model->car_brand->country->id;
                            $url=$this->createUrl('/catalog'.$param);
                        ?>
                    <li>Марка: <a href="<?=$url?>"><?=$model->model->car_brand->name?></a></li>
					<li>Пробег: <?=$model->dop->mileage?></li>
					<li>Состояние: <?=$model->dop->getState()?></li>
					<li>Объем двигателя: <?=$model->force?></li>
					<li>Коробка передач: <?=$model->dop->getTransmissionType()?></li>
					<li>Тип кузова: <?=$model->bascet?></li>
					<li>Цена: <?=number_format($model->price,0,' ',' ') ?> руб.</li>
					<li><a href="#own-price" class="own-price"><span>Предложить свою цену</span></a></li>
                    </ul>

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
                    
                    <?$url=$this->createUrl('/catalog',Yii::app()->session->get('BackToSearchUrl'))?>
                    <a href="<?=$url?>">
                        Вернуться к результатам поиска
                    </a>
                </div>
                <div class="clear"></div>
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
<?=$this->renderPartial('//forms/ownPrice',array('model'=>new Ownprice),true);?>