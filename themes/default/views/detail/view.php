   <div class="gallery">
        <div class="big-img">
            <a class="gallery" href="<?=$model->getGallery()->galleryPhotos[0]->getUrl('big')?>">
                <img src="<?=$model->getGallery()->galleryPhotos[0]->getUrl('normal')?>">
            </a>
        </div>
        <div class="min-img">
            <ul>
            <?
                foreach ($model->getGallery()->galleryPhotos as $key => $value) 
                {
                    echo CHtml::link(CHtml::image($value->getUrl('small'), "",array()),$value->getUrl('big'), array());
                }
            ?>
            </ul>
        </div>
    </div>

    <div class="desc">

        <ul>
            <li>
                Раздел: <a href="/detail/parts?id=<?=$model->category->cat_parent->id?>"><?=$model->category->cat_parent->name?></a>
            </li>
            <li>
                Модель авто: <a href="/detail/parts?model=<?=$model->car_model->id?>"><?=$model->car_model->name?></a>
            </li>
            <li>
                Кол-во: 1
            </li>
            <li>
                Артикул: 0123950
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