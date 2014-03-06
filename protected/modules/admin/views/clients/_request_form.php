<div class="client-block">
	<?php echo TbHtml::activeRadioButtonList($model,'type', Clients::getTypes()); ?>

	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span12','maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Clients_email"><?=$model->getAttributeLabel('phone')?></label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array('class' => 'span12')
			));
			?>
		</div>
	</div>
</div>