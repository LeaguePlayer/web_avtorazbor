<div class="page">

            <h1 class="head">
                <?=$model->name?>
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <?=$this->renderPartial('//detail/scrollBar',array('dataProvider'=>$dataProvider,'model_id'=>$model->id),true);?>
                </div>

                <div class="coll-right">

                    <div class="content clear">

                        <div class="gallery">
                            <div class="big-img">
                                <?
                                    $gallery=$model->getGallery()->galleryPhotos;
                                    $image=$gallery ? $gallery[0]->getUrl('normal') : '/media/images/parts/default.jpg';
                                    $bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
                                ?>
                                <a class="imgFancy" href="<?=$bigImage?>"><img width="331" height="192" src="<?=$image?>" alt="" title="" />
                            </div>
                            <div class="min-img">
                            <?
                                if ($gallery)
                                {
                            ?>
                                <ul>
                                    <?
                                    $counter=0;
                                    if (count($gallery)>1)
                                    {
                                        for($i=1;$i<count($gallery); $i++){

                                            $value=$gallery[$i];
                                            if (($counter+=1)<6)
                                            {
                                                ?>
                                                <a class="imgFancy" rel="1" href="<?=$value->getUrl('big')?>">
                                                    <img width="100" height="60" src="<?=$value->getUrl('small')?>" />
                                                </a>
                                                <?
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            <?}?>
                            </div>
                        </div>

                        <div class="desc">

                            <ul>
                                <li>
                                    Раздел: <a href="/detail/parts?Categories=<?=$model->category->id;?>&subCategories=<?=$model->category->parent;?>"><?=$model->category->name;?></a>
                                </li>
                                <li>
                                    Модель авто: <a href="/detail/parts?carModels=<?=$model->car_model->id;?>"><?=$model->car_model->name;?></a>
                                </li>
                                
                                <li >
                                   Артикул:  <span class="articl"><?=$model->id?></span>
                                </li>
                                <?
                                    foreach ($model->category->attrs as $key => $value) {
                                        ?>
                                            <li>
                                                <?=$value->attr?>: <?=$value->getValue($model->id)?>
                                            </li>
                                        <?
                                    }
                                ?>
                                <li>
                                    Комментарий: <?=$model->comment?>
                                </li> 
                                <li>
                                    Цена: <?=number_format($model->price_sell,0,' ',' ')?> руб.
                                </li>  
                            </ul>
                            <div class="submit">
                                <a href="#" class="i-submit inCart">В корзину</a>
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

                                    <!-- <ul>
                                        <li class="vk">
                                            <a href="#"></a>
                                        </li>
                                        <li class="fb">
                                            <a href="#"></a>
                                        </li>
                                        <li class="gp">
                                            <a href="#"></a>
                                        </li>
                                        <li class="tw">
                                            <a href="#"></a>
                                        </li>
                                        <li class="od">
                                            <a href="#"></a>
                                        </li>
                                    </ul> -->
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