	<?
		$data=Parts::model()->findByPk($data['id']);
		$glr=$data->getGallery()->galleryPhotos;
		$image=$glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.png';
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
		<?=number_format($data->price_sell,0,' ',' ')?> руб.
	</span>
</li>