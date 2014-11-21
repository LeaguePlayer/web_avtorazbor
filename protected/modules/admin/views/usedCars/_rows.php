	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
		<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
		
		<div class='img_preview'>
			<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='UsedCars' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_preview'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8 name','maxlength'=>255)); ?>	
	<?php echo $form->textFieldControlGroup($model,'alias',array('class'=>'span8 alias','maxlength'=>255)); ?>	
	
	<div class="control-group">
		<label class="control-label" for="UsedCars_car_model_id"><?=$model->getAttributeLabel('car_model_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'car_model_id',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
				),
				'htmlOptions'=>array(
					),
						
			)); ?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'vin',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'bascet', array("Легковые"=>UsedCars::getBasketList(),'Грузовые'=>UsedCars::getWeightBasketList()), array('empty'=>'Выберите тип кузова', 'class'=>'span8', 'displaySize'=>1, 'id' => 'bascet1')); ?>
	

	<?php echo $form->textFieldControlGroup($model,'force',array('class'=>'span8','maxlength'=>20)); ?>


	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'year'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'year',
			'pluginOptions' => array(
				'format' => 'yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false,
                'viewMode' => 'years',
                'minViewMode' => 'years'
			)
		)); ?>
		<?php echo $form->error($model, 'enter_date'); ?>
	</div>

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
	<div class="owner"<?=$model->status != 2 ? ' style="display: none;"' : ''?>>
	<?php
		$this->renderPartial('/clients/_owner', array(
			'model' => $model->owner ? $model->owner : $owner,
			'form' => $form
		));
	?>
	</div>

	<script type="text/javascript">
	jQuery('#type').on('change', function(){
		var type = jQuery(this).val();
		type == 2 ? jQuery('.owner').show() : jQuery('.owner').hide();
	});
	</script>