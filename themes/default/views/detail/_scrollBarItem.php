<?
	$data=Parts::model()->findByPk($data['id']);

    $gallery=$data->getGallery()->galleryPhotos;
    if ($gallery[0])
        $image=$gallery[0]->getUrl('small') ? $gallery[0]->getUrl('small') : '/media/images/parts/default.jpg';
    else 
        $image='/media/images/parts/default.jpg';
?>
<li class="<?=$_GET["id"]==$data->id? 'active' : ''?>">

    <a href="/detail/<?=$data->alias?>/<?=$data->id?>" data-id="<?=$data->id?>"> 
    	<img  src="<?=$image?>" alt="" title="" />
    </a>

    <p class="section">
        Раздел: <?=$data->category->name?>
    </p>

    <a href="/detail/<?=$data->alias?>/<?=$data->id?>" data-id="<?=$data->id?>" class="name">
        <?=$data->name;?>
    </a>
    
</li>