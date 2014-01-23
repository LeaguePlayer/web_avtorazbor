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

	<?php echo $form->textFieldControlGroup($model,'price',array('class'=>'span8','maxlength'=>10)); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', UsedCars::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1, 'id' => 'type')); ?>
	
	<div class="dop" style="<? if($model->status != 2){?>display: none;<?}?>">
	<?php
		$this->renderPartial('/usedCarInfo/_rows', array(
			'model' => $model->dop ? $model->dop : $dop,
			'form' => $form
		));
	?>
	</div>

	<script type="text/javascript">
	jQuery('#type').on('change', function(){
		var type = jQuery(this).val();
		type == 2 ? jQuery('.dop').show() : jQuery('.dop').hide();
	});
	</script>