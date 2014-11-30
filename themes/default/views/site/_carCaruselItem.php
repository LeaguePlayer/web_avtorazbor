<div>
    <? 
        $data=UsedCars::model()->findByPk($data['id']);
        $glr=$data->getGallery()->galleryPhotos;
        $image= $glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.jpg';
        //$image='/media/car.png';
    ?>
    <a href="/catalog/<?=$data->alias?>"><img height="100px" width="140px" src="<?=$image?>" alt="" title="" /></a>
    <a href="/catalog/<?=$data->alias?>" class="link">
        <?=$data->name?>
    </a>
    <span class="desc">
        <?=$data->more_info?><br/>
        <?=$data->year ? $data->year.'г.' : '' ?> <?=$data->dop->mileage ? $data->dop->mileage.' км' :''?>.
    </span>
    <span class="price">
        <?=$data->dop->price_sell ?  number_format((int)$data->dop->price_sell ,0,' ',' ') .' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>