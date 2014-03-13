<fieldset>
	<legend>Владелец</legend>
	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_birthday'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_birthday',
			'pluginOptions' => array(
				'format' => 'dd.MM.yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			),
			'htmlOptions' => array(
				'value' => $model->dt_birthday ? SiteHelper::formatDate($model->dt_birthday, 'Y-m-d', 'd.m.Y') : ''
			)
		)); ?>
		<?php echo $form->error($model, 'dt_birthday'); ?>
	</div>
	
	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'passport_num'); ?>
		<?php
			$this->widget('CMaskedTextField', array(
			'model' => $model,
			'attribute' => 'passport_num',
			'mask' => '9999 999999'));
		?>
		<?php echo $form->error($model, 'passport_num'); ?>
	</div>
	<?php //echo $form->textFieldControlGroup($model,'passport_num',array('class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'issued_by',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_of_issue'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_of_issue',
			'pluginOptions' => array(
				'format' => 'dd.MM.yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			),
			'htmlOptions' => array(
				'value' => $model->dt_of_issue ? SiteHelper::formatDate($model->dt_of_issue, 'Y-m-d', 'd.m.Y') : ''
			)
		)); ?>
		<?php echo $form->error($model, 'dt_of_issue'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'phone'); ?>
		<?php
			$this->widget('CMaskedTextField', array(
			'model' => $model,
			'attribute' => 'phone',
			'mask' => '+7 (999) 999-99-99'));
		?>
		<?php echo $form->error($model, 'phone'); ?>
	</div>
	
	<?php //echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'type',array('value'=>1)); ?>
</fieldset>