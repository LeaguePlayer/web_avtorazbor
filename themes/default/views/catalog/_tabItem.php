<li>
	<a href="/catalog/car/<?=$data->id?>">
		<img src="<?=$data->img_preview ? $data->getImageUrl('small') : '/media/images/usedcars/default.jpg'?>" alt="" title="" />
	</a>
	<a href="/catalog/car/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	<span class="dsc">
		<?=$data->comment?><br/>
					<?=$data->year?>г.
	</span>
	<span class="price">
	цена
		<?=$data->price?>
	</span>
</li>