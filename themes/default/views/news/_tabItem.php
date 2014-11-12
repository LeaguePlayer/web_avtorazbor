<li class="item">
    <a href="/catalog/<?=$data->url?>/<?=$data->id?>"><img src="<?=$data->getImageUrl('small')?>" alt="" title=""></a>
    <div >
        <span class="data"><?=$data->year?></span>
        <a href="/catalog/<?=$data->url?>/<?=$data->id?>" class="name"> 
            <?=$data->name?>
        </a>
        <p class="desc">
        	<?=$data->comment?>
        </p>
    </div>
</li>