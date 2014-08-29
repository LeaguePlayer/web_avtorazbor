<div>
    <?
        //$image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/news/default.jpg' ;
    $image='/media/news-preview.png';
    ?>
    <a hrf="/news/view/id/<?=$data->id?>">
    <img src="<?=$image?>" alt="" title="">
    </a>
    <span class="data"><?=date('d-m-y',time($data->create_time))?></span>
    <a href="/news/view/id/<?=$data->id?>" class="name">
        <?=$data->name?>
    </a>
</div>
