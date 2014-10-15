<div class="sale fotorama">
	<?

	$diagnostics=Diagnostic::model()->published()->findAll();

	foreach ($diagnostics as $key => $model) {
		?>
			<div class="item">
		        <img src="<?=$model->getImageUrl()?>" width="100%" alt="" title="<?=$model->title?>"/>
		        <div class="info">
		            <p class="caption">
		                <?=$model->title?>
		            </p>
		            <p class="feature">
		            	<?=$model->announce?>
		            </p>
		            <p class="phone">
		                <?=$model->phone?>
		            </p>
		            <a href="/diagnostic/<?=$model->alias?>">Подробнее</a>
		        </div>
			</div>
		<?
	}

	?>
</div>