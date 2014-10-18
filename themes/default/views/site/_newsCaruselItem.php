<div>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/news/default.jpg' ;
    ?>
    <a hrf="/catalog/<?=$data->alias?>/<?=$data->id?>">
        <img src="<?=$image?>" alt="" title="">
    

    <span class="data">Год выпуска <?=date('d-m-y',time($data->year))?></span>
    </a>
    <a hrf="/catalog/<?=$data->alias?>/<?=$data->id?>">
        <?=$data->name?>
    </a>
</div>
