	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Categories_name">Название категории</label>
		<div class="controls">
			<?php $this->widget('ext.select2.ESelect2', array(
				'model'=>$model,
				'attribute'=>'parent',
				'data'=>array(0 => 'Корневая директория') + CHtml::listData(Categories::model()->findAll('parent=0'), 'id', 'name'),
				'options'=>array(
					'containerCssClass' => 'span8',
					// 'placeholder'=>'Категория',
				),
			)); ?>
		</div>
	</div>

	<style>
	.tab-content{overflow: visible;}
	</style>