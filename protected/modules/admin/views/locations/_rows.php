	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Locations_phone">Телефон</label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99'
			));?>
		</div>
	</div>

	<?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

