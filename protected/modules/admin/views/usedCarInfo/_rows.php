<fieldset>
 
    <legend>Доп опции</legend>

	<?php echo $form->textFieldControlGroup($model,'price_sell',array('class'=>'span8','maxlength'=>10)); ?>

	<?php //echo $form->textFieldControlGroup($model,'year',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'mileage',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model,'state', UsedCarInfo::statesList()); ?>

	<?php echo $form->dropDownListControlGroup($model,'transmission', UsedCarInfo::transmissionList()); ?>

	<?php echo $form->textFieldControlGroup($model,'model_num_engine',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'chassis_num',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'carcass_num',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'color',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'type_ts',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'passport_ts',array('class'=>'span8'))?>

	<?php //echo $form->textFieldControlGroup($model,'passport_ts',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'issued_by',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

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
</fieldset>