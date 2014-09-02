	<?
		$glrExist=!empty($data->getGallery()->galleryPhotos)
	?>
<li>
	<a href="/detail/view?id=<?=$data->id?>">
		<img src="<?= $glrExist ? $data->getGallery()->galleryPhotos[0]->getUrl('small') : '/media/images/parts/default.png'?>" alt="" title="">
	</a>
	<a href="/detail/view?id=<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	<span class="dsc">
		<?=$data->comment?>.<br>
	</span>
	<span class="price">
		<?=$data->price_sell?> руб.
	</span>
	<span><?=var_dump($data->analog)?></span>
</li>