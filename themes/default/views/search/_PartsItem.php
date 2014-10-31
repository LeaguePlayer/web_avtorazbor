<?
    $gallery=$data->getGallery()->galleryPhotos;
	$image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
	$bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
        // $image='/media/car.png';
        // $imageBig='/media/car.png';
?>
<div>
    <a href="/detail/<?=$data->alias?>/<?=$data->id?>"><img src="<?=$image?>" alt="" title="" /></a>
    
    <a href="/detail/<?=$data->alias?>/<?=$data->id?>" class="link">
        <?=$data->car_model->name.' '.$data->category->name?>
    </a>
    <div>
        <span class="desc">
        	<strong>Коментарий:<br></strong>
            <?=$data->comment?>
        </span>
        <span class="price">
            <?= $data->price_sell ? number_format((int)$data->price_sell,0,' ',' ').' руб.' : ''?> 
        </span>
    </div>
</div>