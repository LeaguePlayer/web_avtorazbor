<li class="item">
    <a href="/catalog/<?=$data->alias?>/<?=$data->id?>"><img src="<?=$data->getImageUrl('small')?>" alt="" title=""></a>
    <div >
        <span class="data"><?=$data->year?></span>
        <a href="/catalog/<?=$data->alias?>/<?=$data->id?>" class="name"> 
            <?=$data->comment?>
        </a>
    </div>
</li>