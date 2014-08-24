<div>
    <?

        $url='SearchFormOnMain[id_country]='.$data->model->car_brand->id_country.'&SearchFormOnMain[brand]='.$data->model->car_brand->id.'&SearchFormOnMain[car_model_id]='.$data->model->id.'&SearchFormOnMain[transmission]='.$data->dop->transmission.'&SearchFormOnMain[bascet]='.$data->bascet;
    ?>
    <?
        $image=$data->getImageUrl('small') ? $data->getImageUrl('small') : '/media/images/usedcars/default.jpg';
    ?>
    <a href="/catalog?<?=$url?>"><img src="<?=$image?>" alt="" title="" /></a>
    <a href="/catalog?<?=$url?>" class="link">
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