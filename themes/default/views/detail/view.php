<div class="page">

            <h1 class="head">
                <?=$model->name?>
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <?=$this->renderPartial('//detail/scrollBar',array('dataProvider'=>$dataProvider),true);?>
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
                                <a class="imgFancy" rel="1" href="<?=$bigImage?>"><img width="331" height="192" src="<?=$image?>" alt="" title="" />
                            </div>
                            <div class="min-img">
                            <?
                                if ($gallery)
                                {
                            ?>
                                <ul>
                                    <?
                                    $counter=0;
                                        foreach ($gallery as $key => $value) {

                                            if (($counter+=1)<6)
                                            {
                                                ?>
                                                <a class="imgFancy" rel="1" href="<?=$value->getUrl('big')?>">
                                                    <img width="100" height="60" src="<?=$value->getUrl('small')?>" />
                                                </a>
                                                <?
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
                                
                                <li>
                                    Артикул: <?=$model->id?>
                                </li>
                                <li>
                                    Комментарий: <?=$model->comment?>
                                </li> 
                                <li>
                                    Цена: <?=$model->price_sell?> руб.
                                </li>     
                            </ul>
                            <div class="submit">
                                <input type="submit" value="В корзину" class="i-submit" />
                            </div>

                        </div>

                        <div class="shared clear">
                            <dl>
                                <dt>
                                    Поделиться:
                                </dt>
                                <dd>
                                    <ul>
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
                                    </ul>
                                </dd>
                            </dl>
                        </div>

                        <div class="readmore">
                            <a href="javascript:history.back(1)">
                                Вернуться к результатам поиска
                            </a>
                        </div>

                        <div class="clear"></div>

                    </div>

                    

                </div>


                <div class="clear"></div>
            </div>
        </div>  