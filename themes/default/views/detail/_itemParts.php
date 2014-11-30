	<?
		$glr=Gallery::model()->findByPk($data['gallery_id'])->galleryPhotos;
		$image=$glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.png';
	?>
<li>
	<a href="/detail/<?=$data->alias?>">
		<img src="<?=$image?>" alt="" title="">
	</a>
	<a href="/detail/<?=$data->alias?>" class="link">
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