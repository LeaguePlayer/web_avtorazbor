	<?
		$glrExist=!empty($data->getGallery()->galleryPhotos);
		$glr=$data->getGallery()->galleryPhotos[0];
		$image=$glrExist ? $glr->getUrl('small') : '/media/images/parts/default.png';
	?>
<li>
	<a href="/detail/<?=$data->url?>/<?=$data->id?>">
		<img src="<?=$image?>" alt="" title="">
	</a>
	<a href="/detail/<?=$data->url?>/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	
	<span class="dsc">
		<?=$data->comment?>.<br>
	</span>
	<span class="dsc" style="fron-size:16px;color:red"><?=$data->analog ? 'Аналог' : ''?></span>
	<span class="price">
		<?=$data->price_sell?> руб.
	</span>
</li>