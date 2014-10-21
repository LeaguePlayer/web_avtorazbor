<div class="item">
	<img src="<?=$data->getImageUrl()?>" alt=""/>
	<div class="info">
		<p class="caption"><?=$data->title?></p>
		<p class="desc"><?=$data->announce?></p>
		<a href="/diagnostic/<?=$data->alias?>/<?=$data->id?>" class="i-submit">Подробнее</a>
	</div>
</div>