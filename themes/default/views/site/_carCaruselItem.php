<div>

    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/usedcars/default.jpg';
    ?>
    <a href="#"><img src="<?=$image?>" alt="" title="" /></a>
    <a href="#" class="link">
        <?=$data->name?>
    </a>
    <span class="dsc">
        <?=$data->comment?><br/>
        <?=$data->year?> г., <?=$data->dop->mileage?>.
    </span>
    <span class="price">
        <?=$data->price?> руб.
    </span>
    <span class="price_old">    
        как сделать??
    </span>
</div>