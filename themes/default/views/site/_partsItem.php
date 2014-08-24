<?
    $gallery=$data->getGallery()->galleryPhotos;
	$image=$gallery ? $gallery[0]->getUrl('normal') : '/media/images/parts/default.jpg';
	$bigImage=$gallery ? $gallery[0]->getUrl('big') : '/media/images/parts/default.jpg';
?>
<div>
    <?
        $scenario=$_GET['SearchFormOnMain']['scenario'] ? $_GET['SearchFormOnMain']['scenario'] : 'light'; 
        $url='SearchFormOnMain[country]='.$data->car_model->car_brand->id_country.'&SearchFormOnMain[brand]='.$data->car_model->car_brand->id.'&SearchFormOnMain[car_model_id]='.$data->car_model_id.'&SearchFormOnMain[category_id]='.$data->category_id.'&SearchFormOnMain[parent]='.$data->category->parent;
    ?>
    <a href="/detail/parts?<?=$url?>"><img src="<?=$image?>" alt="" title="" /></a>
    
    <a href="/detail/parts?<?=$url?>" class="link">
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