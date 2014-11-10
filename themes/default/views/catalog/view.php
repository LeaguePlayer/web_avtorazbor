<div class="page">
    <h1 class="head">
        <?=$model->name?>
    </h1>

    <div class="wr">

        <div class="coll left" >

            <div class="content clear">

                <div class="gallery">
                    <div class="big-img">
                        <?
                            $image=$model->getImageUrl('medium') ? $model->getImageUrl('medium') : '/media/images/default.png';
                        ?>
                        <a class="imgFancy" href="<?=$model->getImageUrl() ? $model->getImageUrl('big') : '/media/images/default.png' ?>"><img width="331" height="192" src="<?=$image?>" alt="" title="" /></a>
                    </div>
                </div>

                <div class="desc desc-view">
                    <ul>
                        <?
                            $param="?Search[brand]=".$model->model->car_brand->id."&Search[id_country]=".$model->model->car_brand->country->id;
                            $url=$this->createUrl('/catalog'.$param);
                        ?>
                    <li class="articul">Артикул: <span><?=$model->id?></span></li>
                    <li>Марка: <a href="<?=$url?>"><?=$model->model->car_brand->name?></a></li>
					<li>Пробег: <?=$model->dop->mileage?></li>
					<li>Состояние: <?=$model->dop->getState()?></li>
					<li>Объем двигателя: <?=$model->force?></li>
					<li>Коробка передач: <?=$model->dop->getTransmissionType()?></li>
					<li>Тип кузова: <?=$model->bascet?></li>
					<li>Цена: <?=number_format($model->price,0,' ',' ') ?> руб.</li>
                    <?if (!Yii::app()->user->isAdmin){?>
					   <li><a href="#own-price" class="own-price"><span>Предложить свою цену</span></a></li>
                    <?}?>
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
                <div class="comeback">
                    <?$url='Search[id_country]='.$model->model->car_brand->id_country.'&Search[brand]='.$model->model->car_brand->id.'&Search[car_model_id]='.$model->model->id.'&Search[transmission]='.$model->dop->transmission.'&Search[bascet]='.$model->bascet;
                    ?>
                    <?$url=$this->createUrl('/catalog?'.$url)?>
                    <a href="<?=$url?>">
                        Вернуться к результатам поиска
                    </a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="coll right">
            <div class="modul one">

                            <p class="phone">+7 (343) 201-36-06</p>
                            <a href="/evackuator">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                    <div class="modul second">
                            <p class="question">Есть вопросы?<br>
                                <span>Напиши нам</span>
                            </p>
                            <a href="#popup" class="modal">
                                Задать вопрос
                            </a>
                    </div>
        </div> 

        <div class="clear"></div>
    </div>
</div>  
<?=$this->renderPartial('//forms/ownPrice',array('model'=>new Ownprice,'user_id'=>Yii::app()->user->id),true);?>