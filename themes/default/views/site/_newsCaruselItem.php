<div>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/news/default.jpg' ;
    ?>
    <a hrf="/news/<?=$data->alias?>">
        <img src="<?=$image?>" alt="" title="">
    

    <span class="data"><?=date('d-m-y',time($data->create_time))?></span>
    </a>
    <a href="/news/<?=$data->alias?>" class="name">
        <?=$data->name?>
    </a>
</div>
