<?
	$diagnostics=Diagnostic::model()->findAll('status=1');
	if ($diagnostics){?>
<div class="head-carusel">
	<?
		foreach ($diagnostics as $key => $data) {
			$this->renderPartial('//layouts/_diagnosticItem',array('data'=>$data));
		}
	?>
</div>
<script type="text/javascript">
	$('.head-carusel img').width($(document).width());
</script>
<?}?>