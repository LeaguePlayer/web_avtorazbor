<li>
	<?
		$image=$data->img_preview ? $data->getImageUrl('small') : '/media/images/usedcars/default.png';
	?>
	<a href="/catalog/car/<?=$data->id?>">
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