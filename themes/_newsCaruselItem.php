<div>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/news/default.jpg' ;
    ?>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>">
        <img src="<?=$image?>" alt="" title="">
    

    <span class="data"><?=date('d.m.y',time($data->year))?></span>
    </a>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>">
        <?=$data->name?>
    </a>
</div>