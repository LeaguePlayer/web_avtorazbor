<li>
	 <?
	    $glr=$data->getGallery()->galleryPhotos;
	    $image= $glr ? $glr[0]->getUrl('small') : '/media/images/usedcars/default.jpg';
	?>
	<a href="/catalog/<?=$data->url?>/<?=$data->id?>">
		<img src="<?=$image?>" alt="" title="" />
	</a>
	<a href="/catalog/car/<?=$data->id?>" class="link">
		<?=$data->name?>
	</a>

	
	<span class="dsc">
		<?=$data->comment?><br/>
					<?=$data->year?>г.
	</span>
	<span class="price">
		<?=number_format($data->price,0,'',' ')?> руб.
	</span>
</li>