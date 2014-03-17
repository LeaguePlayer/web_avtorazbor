<h2>Просмотр запчасти - <?=CHtml::encode($model->name)?></h2>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'category.name',
		array(
			'name'=>'price_sell',
			'type'=>'raw',
			'value'=>number_format($model->price_sell, 0, '', ' ').' р.',
		),
		array(
			'name'=>'price_buy',
			'type'=>'raw',
			'value'=>number_format($model->price_buy, 0, '', ' ').' р.',
		),
		array(
			'name'=>'car_model_id',
			'type'=>'raw',
			'value'=>$model->car_model->car_brand->name.' '.$model->car_model->name,
		),
		'location.name',
		'supplier.name',
		array(
			'label'=>'Б/У автомобиль',
			'type'=>'raw',
			'value'=>$model->usedCar ? 'VIN - '.$model->usedCar->vin : 'нет',
		)
		// 'owner.name',        // an attribute of the related object "owner"
		// 'description:html',  // description attribute in HTML
		/*array(               // related city displayed as a link
			'label'=>'City',
			'type'=>'raw',
			'value'=>CHtml::link(CHtml::encode($model->city->name), array('city/view','id'=>$model->city->id)),
		),*/
	),
));
?>

<br>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'parts-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
			<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_SUCCESS)); ?>
		</div>
		<div class="span6">
			<?php
			echo TbHtml::buttonGroup(array(
				array('label' => 'Утилизация', 'color' => TbHtml::BUTTON_COLOR_DANGER),
				array('label' => 'На продажу', 'color' => TbHtml::BUTTON_COLOR_SUCCESS, 'class' => 'active'),
			), array('toggle' => TbHtml::BUTTON_TOGGLE_RADIO));
			?>
			<?php echo TbHtml::link('Редактировать', $this->createUrl('update', array('id' => $model->id))); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>

<fieldset id="analog-block" data-id="<?=$model->id?>">
	<legend>Аналоги</legend>
	<?php $this->renderPartial('_analogs', array('model' => $model, 'analogs' => $analogs)); ?>
</fieldset>