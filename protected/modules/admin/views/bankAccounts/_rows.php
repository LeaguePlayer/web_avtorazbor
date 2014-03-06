<?if(!empty($models)):?>
<fieldset>
	<legend>Счета</legend>
	<div class="accounts">
		<?foreach ($models as $key => $model):?>
			<? $id = $model->id ? $model->id : $key + 1; ?>
			<? $this->renderPartial('/bankAccounts/_row', array('id' => $id, 'model'=> $model)); ?>
		<?endforeach;?>
	</div>
	<?php echo TbHtml::linkButton('Добавить счет', array('url'=>'#', 'class' => 'add-acc')); ?> 
</fieldset>
<script>
	var count = jQuery('.accounts .acc').length + 1;

	jQuery('.add-acc').on('click', function(e){
		e.preventDefault();

		jQuery.ajax({
			url: '<?=$this->createUrl("addRow")?>',
			data: {index: count},
			success: function(data){
				jQuery('.accounts').append(data);
				count++;
			}
		});
	});
</script>
<?endif;?>
