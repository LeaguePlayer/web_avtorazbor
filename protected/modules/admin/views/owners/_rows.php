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
			)
		)); ?>
		<?php echo $form->error($model, 'dt_birthday'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'passport_num',array('class'=>'span8')); ?>

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
			)
		)); ?>
		<?php echo $form->error($model, 'dt_of_issue'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'used_car_id',array('class'=>'span8')); ?>
</fieldset>