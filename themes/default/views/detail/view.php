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

                                   if ($gallery[0])
                                   {
                                    
                                        $image=$gallery[0]->getUrl('normal');
                                        $bigImage=$gallery[0]->getUrl('big');
                                        unset($gallery[0]);
                                   }
                                    else 
                                    {
                                        $image= '/media/images/parts/default.jpg';
                                        $bigImage='/media/images/parts/default.jpg';
                                    }
                                ?>
                                <a class="imgFancy" rel="1" href="<?=$bigImage?>"><img width="331" height="192" src="<?=$image?>" alt="" title="" /></a>
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
                                                <a class="imgFancy" rel="1" href="<?=$data->getUrl('big')?>">
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
                                <li>
                                    <?
                                    $category_id=$model->category->parent ? $model->category->cat_parent->id : $model->category_id;
                                    $urlParam='Search[scenario]=Parts&Search[brand]='.$model->car_model->car_brand->id.'&Search[car_model_id]='.$model->car_model_id.'&Search[category_id]='.$category_id.'&Search[parent]='.$model->category->parent.'&Search[type]='.$model->car_model->car_type;
                                    ?>
                                    Раздел: <a href="/parts?<?=$urlParam?>"><?=$model->category->name;?></a>
                                </li>
                                <li>
                                    Модель авто: <a href="<?=$return?>"><?=$model->car_model->name;?></a>
                                </li>
                                <li>
                                   Артикул:  <span class="articl"><?=$model->id?></span>
                                </li>
                                <?
                                    $attrs=$model->category->attrs;

                                    if ($attrs)
                                    foreach ($attrs as $key => $value) {
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
                            <?
                                if (!Yii::app()->user->isAdmin){
                            ?>
                            <div class="submit">
                                <a href="<?=$state ? '/cart' : '#'?>" class="i-submit <?=!$state ? 'inCart' : ''?>" data-state="<?=$state?>"  data-count="<?=Yii::app()->cart->getCount()?>" data-cost="<?=Yii::app()->cart->getCost()?>" data-price="<?=!$model->inCart() ? $model->getPrice() : ''?>"><?=$state ? 'Перейти в карзину' : 'В карзину' ?></a>
                            </div>
                            <?}?>
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

                            <?
                                
                            ?>
                            <a href="<?=$return?>">
                                Вернуться к результатам поиска
                            </a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>  
    <?=$this->renderPartial('itemIncart',array('model'=>$model))?>