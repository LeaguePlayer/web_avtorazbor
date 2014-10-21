<div class="head-carusel">
	<?
		foreach ($diagnostics as $key => $data) {
			$this->renderPartial('_headerCaruselitem',array('data'=>$data));
		}
	?>
</div>