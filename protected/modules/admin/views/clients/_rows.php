	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Clients_email"><?=$model->getAttributeLabel('phone')?></label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array('class' => 'span8')
			));
			?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
	<?php echo $form->dropDownListControlGroup($model,'type', Clients::getTypes(), array('id' => 'type')); ?>
	
	<div class="info" style="<? if($model->type != 2){?>display: none;<?}?>">
	<?php
		$this->renderPartial('/clientsInfo/_rows', array(
			'model' => $model->info ? $model->info : $info,
			'form' => $form
		));
	?>
	<?php
		$this->renderPartial('/bankAccounts/_rows', array(
			'models' => $accounts,
			'form' => $form
		));
	?>
	</div>

	<script type="text/javascript">
	jQuery('#type').on('change', function(){
		var type = jQuery(this).val();
		type == 2 ? jQuery('.info').show() : jQuery('.info').hide();
	});
	</script>