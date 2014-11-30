<?
    $data=Parts::model()->findByPk($data['id']);
	$glr=$data->getGallery()->galleryPhotos;
    $image=$glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.png';
?>
<div>
    <a href="/detail/<?=$data->alias?>"><img src="<?=$image?>" alt="" title="" data-glr="<?=count($glr)?>"/></a>
    
    <a href="/detail/<?=$data->alias?>" class="link">
        <?=$data->car_model->name.' '.$data->category->name?>
    </a>
    <span class="desc">
        <?=$data->comment?>
    </span>
    <span class="price">
        <?= $data->price_sell ? number_format((int)$data->price_sell,0,' ',' ').' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>