<?
	$image = get_class($data)=="Parts" ? $data->gallery->galleryPhotos[0]->getUrl('small'): $data->getImageUrl('small');
?>

<!-- <div class="item">
    <a href="/catalog/<?=$data->alias?>/<?=$data->id?>"><img src="<?=$image?>" alt="" title=""></a>
    <div >
        <span class="data"><?=$data->name?></span>
        <a href="/catalog/<?=$data->alias?>/<?=$data->id?>" class="name"> 
            <?=$data->comment?>
        </a>
    </div>
</div> -->
<div class="item">
    <a href="/catalog/<?=$data->alias?>/<?=$data->id?>"><img src="<?=$image?>" alt="" title=""></a>
    <div>
        <span class="data"><?=$data->year ? $data->year : ''?></span>
        <a href="/catalog/<?=$data->name?>/<?=$data->id?>" class="name"><?=$data->name?></a>
        <p class="desc">
        	<?=$data->comment?>	
        </p>
    </div>
</div>