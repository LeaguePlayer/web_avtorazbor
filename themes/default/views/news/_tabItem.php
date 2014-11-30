 <?
    $glr=$data->getGallery()->galleryPhotos;
    $image= $glr ? $glr[0]->getUrl('small') : '/media/images/usedcars/default.jpg';
?>

<li class="item">
    <a href="/catalog/<?=$data->alias?>"><img src="<?=$image?>" alt="" title=""></a>
    <div >
        <span class="data"><?=$data->year?></span>
        <a href="/catalog/<?=$data->alias?>" class="name"> 
            <?=$data->name?>
        </a>
        <p class="desc">
        	<?=$data->comment?>
        </p>
    </div>
</li>