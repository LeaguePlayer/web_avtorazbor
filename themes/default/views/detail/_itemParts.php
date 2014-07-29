	<?
		$data=Parts::model()->findByPk($data['id']);
		$glrExist=!empty($data->getGallery()->galleryPhotos)
	?>
<li>
	<a href="/detail/view/<?=$data->id?>">
		<img src="<?= $glrExist ? $data->getGallery()->galleryPhotos[0]->getUrl('small') : '/media/images/parts/default.jpg'?>" alt="" title="">
	</a>
	<a href="/detail/view/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>
	<span class="dsc">
		<?=$data->comment?>.<br>
	</span>
	<span class="price">
		<?=$data->price_buy?> руб.
	</span>
	<!-- <span class="price_old">	
		200 000
	</span> -->
</li>