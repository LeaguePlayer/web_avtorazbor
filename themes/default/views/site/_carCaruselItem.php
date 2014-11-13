<div>
    <?
        $image=$data->getImageUrl() ? $data->getImageUrl('small') : '/media/images/usedcars/default.jpg';
        //$image='/media/car.png';
    ?>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>"><img src="<?=$image?>" alt="" title="" /></a>
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>" class="link">
        <?=$data->name?>
    </a>
    <span class="desc">
        <?=$data->comment?><br/>
        <?=$data->year ? $data->year.'г.' : '' ?> , <?=$data->dop->mileage ? $data->dop->mileage.' км' :''?>.
    </span>
    <span class="price">
        <?=$data->price ?  number_format((int)$data->price,0,' ',' ') .' руб.' : ''?> 
    </span>
    <!-- <span class="price_old">    
        как сделать??
    </span> -->
</div>