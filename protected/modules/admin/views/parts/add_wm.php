<?php
	die('stop');
	$step = 500;
	$page = 11;

	$criteria = new CDbCriteria;
	$criteria->select = 'id';
	$criteria->order = 'id';

	$criteria->limit = $step;
	$criteria->offset = ($page - 1) * $step;

	//print_r($criteria); die();
?>
<style>
	.wait{ background: yellow; }
	.success{ background: green; color: #fff; }
	.error{ background: red; color: #fff; }
</style>
<table width="100%">
	<tr>
		<th>id</th>
		<th class="update">Статус</th>
	</tr>
	<?php foreach (Parts::model()->findAll($criteria) as $part): ?>
		<tr class="wait">
			<td class="id" data-id="<?=$part->id?>"><?=$part->id?></td>
			<td>Не обновлено</td>
		</tr>
		<?php //break; ?>
	<?php endforeach; ?>
</table>
<script>
	jQuery(document).ready(function(){
		setTimeout(function(){
			//----------------------------------
			jQuery('.id').each(function(){
				var $this = jQuery(this);

				setTimeout(function(){
					jQuery.ajax({
						url: '/admin/parts/addWM',
						data: { id: $this.data('id') },
						success: function(res){
							if(res === 'ok') {
								$this.next().text('Обновлено');
								$this.parent().addClass('success');
							}
						},
						error: function(){
							$this.next().text('Ошибка');
							$this.parent().addClass('error');
						}
					});
				}, 2000);
			});
			//----------------------------------
		}, 2000);
	});
</script>