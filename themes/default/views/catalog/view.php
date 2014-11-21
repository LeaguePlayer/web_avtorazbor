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
                            $gallery=$model->getGallery()->galleryPhotos;
                            $image=$gallery[0] ? $gallery[0]->getUrl('view') : '/media/images/default.png';
                        ?>
                        <a class="imgFancy" href="<?=$gallery[0] ? $gallery[0]->getUrl('original') : '/media/images/default.png' ?>"><img width="100%" src="<?=$image?>" alt="" title="" /></a>
                    </div>
                    <div class="min-img">
                    <?
                        if ($gallery)
                        {
                    ?>
                        <ul>
                            <?
                            $counter=0;
                               foreach ($gallery as $key => $data) {

                                    if (($counter+=1)<6)
                                    {
                                        ?>
                                        <a class="imgFancy" rel="1" href="<?=$data->getUrl('original')?>">
                                            <img width="100" height="60" src="<?=$data->getUrl('small')?>" />
                                        </a>
                                        <?
                                    }
                                }
                            ?>
                        </ul>
                    <?}?>
                    </div>
                </div>

                <div class="desc desc-view">
                    <ul>
                        <?
                            $param="?Search[brand]=".$model->model->car_brand->id."&Search[id_country]=".$model->model->car_brand->country->id;
                            $url=$this->createUrl('/catalog'.$param);
                        ?>
                    <li class="articul">Артикул: <span><?=$model->id?></span></li>
                    <li>Двигатель: <?=$model->dop->engine ? UsedCarInfo::getEngineList($model->dop->engine):' ' ?> <?=$model->force ? $model->force.'(Л.С.)' : ''?></li>
                    <li>Коробка передач: <?=$model->dop->getTransmissionType()?></li>
                    <li>Тип кузова: <?=UsedCars::getBasketList($model->bascet)?></li>
                    <li>Марка: <a href="<?=$url?>"><?=$model->model->car_brand->name?></a></li>
					<li>Пробег: <?=number_format($model->dop->mileage,0,' ',' ')?></li>
					<li><strong>Состояние:</strong> <?=$model->dop->getState()?></li>
					<li>Объем двигателя: <?=$model->force?></li>
					
					
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

                            <p class="phone"><?=Settings::getValue('evacuator_phone')?></p>
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