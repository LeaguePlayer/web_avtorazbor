<div>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/news/default.jpg' ;
    ?>
    <a hrf="/news/view/<?=$data->id?>">
    <img src="<?=$image?>" alt="" title="">
    </a>
    <span class="data"><?=date('d-m-y',time($data->create_time))?></span>
    <a href="/news/view/<?=$data->id?>" class="name">
        <?=$data->name?>
    </a>
</div>