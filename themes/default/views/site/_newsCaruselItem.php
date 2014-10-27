<div>
    <?
        $image=$data->getImageUrl('carusel') ? $data->getImageUrl('carusel') : '/media/images/news/default.jpg' ;
    ?>
    <a href="/catalog/<?=$data->alias?>/<?=$data->id?>">
        <img src="<?=$image?>" alt="" title="">
    

    <span class="data"><?=date('d.m.y',time($data->year))?></span>
    </a>
    <a href="/catalog/<?=$data->alias?>/<?=$data->id?>">
        <?=$data->name?>
    </a>
</div>
