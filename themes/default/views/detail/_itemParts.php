	<?
		$glrExist=!empty($data->getGallery()->galleryPhotos)
	?>
<li>
	<a href="/detail/view/<?=$data->id?>">
		<img src="<?= $glrExist ? $data->getGallery()->galleryPhotos[0]->getUrl('small') : '/media/images/parts/default.png'?>" alt="" title="">
	</a>
	<a href="/detail/view/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	<span class="dsc">
		<?=$data->comment?>.<br>
	</span>
	<span class="price">
		<?=number_format($data->price_buy,0,'',' ')?> руб.
	</span>
	<!-- <span class="price_old">	
		200 000
	</span> -->
</li>