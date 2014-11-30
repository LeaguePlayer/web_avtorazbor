<?
    $gallery=$data->getGallery()->galleryPhotos;
	$image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
	$bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
        // $image='/media/car.png';
        // $imageBig='/media/car.png';
?>
<div>
    <a href="/detail/<?=$data->alias?>"><img src="<?=$image?>" alt="" title="" /></a>
    <div>
        <a href="/detail/<?=$data->alias?>" class="name">
            <?=$data->car_model->name.' '.$data->category->name?>
        </a>
        <span class="desc">
        	<strong>Коментарий:<br></strong>
            <?=$data->comment?>
        </span>
        
        <span class="price">
            <?= $data->price_sell ? number_format((int)$data->price_sell,0,' ',' ').' руб.' : ''?> 
        </span>
    </div>
</div>