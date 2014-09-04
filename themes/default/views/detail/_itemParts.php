	<?
		$glrExist=!empty($data->getGallery()->galleryPhotos);
		$glr=$data->getGallery()->galleryPhotos[0];
		$image=$glr->getUrl('small') ? $glr->getUrl('small') : '/media/images/parts/default.png';
	?>
<li>
	<a href="/detail/view?id=<?=$data->id?>">
		<img src="<?=$image?>" alt="" title="">
	</a>
	<a href="/detail/view?id=<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	<span>Коментарий</span>
	<span class="dsc">
		<?=$data->comment?>.<br>
	</span>
	<span class="dsc"><?=$data->analog ? 'Аналог' : ''?></span>
	<span class="price">
		<?=$data->price_sell?> руб.
	</span>
</li>