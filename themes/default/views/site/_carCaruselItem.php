<div>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/usedcars/default.jpg';
        //$image='/media/car.png';
    ?>
    <a href="/catalog/view?id=<?=$data->id?>"><img src="<?=$image?>" alt="" title="" /></a>
    <a href="/catalog?<?=$url?>" class="link">
        <?=$data->name?>
    </a>
    <span class="dsc">
        <?=$data->comment?><br/>
        <?=$data->year ? $data->year.'г.' : '' ?> , <?=$data->dop->mileage ? $data->dop->mileage.' км' :''?>.
    </span>
    <span class="price">
        <?=$data->price ? $data->price.' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>