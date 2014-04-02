	<h3>Связка моделей по категории</h3>
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('cat_id')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'cat_id',
				'data'=>CHtml::listData(Categories::all(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('model_1')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'model_1',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('model_2')?></label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'model_2',
				'data'=>CHtml::listData(CarModels::brandModelsList(), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8 no-float',
					// 'placeholder'=>'Категория',
				)
			)); ?>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<?php //echo $form->textFieldControlGroup($model,'model_1',array('class'=>'span8')); ?>

	<?php //echo $form->textFieldControlGroup($model,'model_2',array('class'=>'span8')); ?>

