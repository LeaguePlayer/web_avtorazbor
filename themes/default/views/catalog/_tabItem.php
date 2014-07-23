<li>
	<img src="<?=$data->img_preview ? $data->getImageUrl() : '/media/images/usedcars/default.jpg'?>" alt="" title="" />
	<a href="#" class="link">
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