<?
    //$gallery=$data->getGallery()->galleryPhotos;
	// $image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
	// $bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
        $image='/media/car.png';
        $imageBig='/media/car.png';
?>
<div>
    <a href="/detail/view/<?=$data->id?>"><img src="<?=$image?>" alt="" title="" /></a>
    
    <a href="/detail/view?id=<?=$data->id?>" class="link">
    	<strong>Раздел: <br></strong>
        <?=$data->category->name?>
    </a>
    <span class="dsc">
    	<strong>Коментарий:<br></strong>
        <?=$data->comment?>
    </span>
    <span class="price">
        <?= number_format((int)$data->price,3,' ',' ')?> руб.
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>