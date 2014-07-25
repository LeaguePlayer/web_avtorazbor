<li class="item">
    <a href="/news/view?id=<?=$data->id?>"><img src="<?=$data->getImageUrl()?>" alt="" title=""></a>
    <div class="right">
        <span class="data"><?=date($data->create_time)?></span>
        <a href="/news/view?id=<?=$data->id?>" class="name">
            <?=$data->name?>
        </a>
    </div>
</li>
