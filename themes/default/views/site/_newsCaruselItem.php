<div>
    <?
        $glr=$data->getGallery()->galleryPhotos;
        $image= $glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.jpg';
    ?>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>">
        <img src="<?=$image?>" alt="" title="">
    

    <span class="data"><?=date('d.m.y',time($data->year))?></span>
    </a>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>">
        <?=$data->name?>
    </a>
</div>
