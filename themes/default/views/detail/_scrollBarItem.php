<?
    $model=$data;
	$data=Parts::model()->findByPk($data['id']);
    $gallery=$data->getGallery()->galleryPhotos;
    if ($gallery[0])
        $image=$gallery ? $gallery[0]->getUrl('small') : '/media/images/parts/default.png';
    else 
        $image='/media/images/parts/default.png';
?>
<li class="<?=$_GET["id"]==$data->id? 'active' : ''?>">
    <a href="/detail/<?=$data->url?>/<?=$data->id?>" data-id="<?=$data->id?>"> 
    	<img  src="<?=$image?>" alt="" title="" />
    </a>
    <p class="section">
        Раздел: <?=$data->category->name?>
    </p>
    <a href="/detail/<?=$data->url?>/<?=$data->id?>" data-id="<?=$data->id?>" class="name">
        <?=$data->name;?>
    </a>
    <span class="dsc" style="fron-size:16px;color:red;font-size:12px;"><?=$model['analog'] ? 'Аналог' : ''?></span>
</li>