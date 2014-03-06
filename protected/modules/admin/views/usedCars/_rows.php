	<div class="control-group">
		<label class="control-label" for="UsedCars_car_model_id"><?=$model->getAttributeLabel('car_model_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'car_model_id',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
				)
			)); ?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'vin',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'year',array('class'=>'span4','maxlength'=>4)); ?>

	<?php echo $form->textFieldControlGroup($model,'price',array('class'=>'span8','maxlength'=>10)); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('class'=>'span8')); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'enter_date'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'enter_date',
			'pluginOptions' => array(
				'format' => 'dd.MM.yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			),
			'htmlOptions' => array(
				'value' => $model->enter_date ? SiteHelper::formatDate($model->enter_date, 'Y-m-d', 'd.m.Y') : gmdate('d.m.Y')
			)
		)); ?>
		<?php echo $form->error($model, 'enter_date'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', UsedCars::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1, 'id' => 'type')); ?>
	
	<div class="dop">
	<?php
		$this->renderPartial('/usedCarInfo/_rows', array(
			'model' => $model->dop ? $model->dop : $dop,
			'form' => $form
		));
	?>
	</div>
	<div class="owners">
	<?php
		$this->renderPartial('/owners/_rows', array(
			'model' => $model->owner ? $model->owner : $owner,
			'form' => $form
		));
	?>
	</div>

	<script type="text/javascript">
	// jQuery('#type').on('change', function(){
	// 	var type = jQuery(this).val();
	// 	type == 2 ? jQuery('.dop').show() : jQuery('.dop').hide();
	// });
	</script>