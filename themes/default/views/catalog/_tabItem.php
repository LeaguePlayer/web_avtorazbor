<li>
	 <?
	    $glr=$data->getGallery()->galleryPhotos;
	    $image= $glr ? $glr[0]->getUrl('small') : '/media/images/parts/default.jpg';
	?>
	<a href="/catalog/<?=$data->alias?>">
		<img width="140px" height="100px" src="<?=$image?>" alt="" title="" />
	</a>
	<a href="/catalog/car/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>

	
	<span class="dsc">
		<?=$data->more_info?><br/>
					<?=$data->year?>г.
	</span>
	<span class="price">
		<?=number_format($data->dop->price_sell,0,'',' ')?> руб.
	</span>
</li>