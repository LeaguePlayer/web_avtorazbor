<?
 //    $gallery=$data->getGallery()->galleryPhotos;
	// $image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
	// $bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
        // $image='/media/car.png';
        // $imageBig='/media/car.png';
$image=$data->getImageUrl('small');
?>
<div>
    <a href="/detail/<?=$data->alias?>/<?=$data->id?>">
        <img src="<?=$image?>" alt="" title="" />
    </a>
    
    <a href="/detail/<?=$data->alias?>/<?=$data->id?>" class="link">
        <?=$data->name?>
    </a>
    <span class="dsc">
    	<strong>Коментарий:<br></strong>
        <?=$data->comment?>
    </span>
    <span class="price">
        <?= $data->price ? number_format((int)$data->price,0,' ',' ').' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>