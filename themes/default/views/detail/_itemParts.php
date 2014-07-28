<li>
    <a href="/detail/view?id=<?=$data->id;?>" data-id="<?=$data->id?>"><img src="<?=(count($data->getGallery()->galleryPhotos)>0 ? $data->getGallery()->galleryPhotos[0]->getUrl('small') : '/media/images/parts/default.jpg')?>" alt="" title="" /></a>
    <p class="section">
        Раздел: <?=$data->category->cat_parent->name?>
    </p> 
    <a href="/detail/view?id=<?=$data->id;?>" data-id="<?=$data->id?>" class="name">
        <?=$data->name;?>
    </a>
</li>