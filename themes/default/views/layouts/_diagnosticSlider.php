<div class="head-carusel">
	<?
	$diagnostics=Diagnostic::model()->findAll('status=1');
	if ($diagnostics)
		foreach ($diagnostics as $key => $data) {
			$this->renderPartial('//layouts/_diagnosticItem',array('data'=>$data));
		}
	?>
</div>
<script type="text/javascript">
	$('.head-carusel img').width($(document).width());
</script>