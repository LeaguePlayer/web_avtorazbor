	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_book'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_book',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			)
		)); ?>
		<?php echo $form->error($model, 'dt_book'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'dt_pay'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'dt_pay',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			)
		)); ?>
		<?php echo $form->error($model, 'dt_pay'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'user_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Cart::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
