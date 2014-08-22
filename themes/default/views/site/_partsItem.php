<?
    $gallery=$data->getGallery()->galleryPhotos;
	$image=$gallery ? $gallery[0]->getUrl('normal') : '/media/images/parts/default.jpg';
	$bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
?>
<div>
    <a href="#"><img src="<?=$image?>" alt="" title="" /></a>
    <a href="/parts?car_type=1&carBrands=1&carModels=&Categories=" class="link">
    	<strong>Раздел: </strong>
        <?=$data->category->name?>
    </a>
    <span class="dsc">
    	<strong>Коментарий:</strong>
        <?=$data->comment?>
    </span>
    <span class="price">
    	<strong>Стоимость:</strong>
        <?=$data->price?> руб.
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>