<?
     $gallery=$data->getGallery()->galleryPhotos;
	   
	// $bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
        // $image='/media/car.png';
        // $imageBig='/media/car.png';
?>
<div>
    <?
        $image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
        //$data=UsedCars::model()->findByPk($data['id']);
    ?>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>"><img src="<?=$image?>" alt="" title="" /></a>
    
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>" class="link">
        <?=$data->name?>
    </a>
    <span class="desc">
        <?=$data->comment?>
    </span>
    <span class="price">
        <?= $data->price ? number_format((int)$data->price,0,' ',' ').' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>