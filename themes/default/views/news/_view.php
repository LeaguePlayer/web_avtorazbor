<div class="item">
	<div class="data-info">
		<p class="name">
			<?=$data->name?>
		</p>
		<p class="publish">
			<?=$data->create_time;?>
		</p>

	</div>
	<div class="preview">
		<a href="/news/<?=$data->id?>">
			<?
				$imgPath=$data->getImageUrl() ? $data->getImageUrl('small') : '/media/news/default.png';
			?>
			<img src="<?=$imgPath?>" alt="" title="">
		</a>
	</div>
	<div class="announce">
	<?=$data->description?>
	</div>
</div>