<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'car-models-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('carmodels')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		array(
			'name' => 'brand',
			'value' => '$data->car_brand->name'
		),
		array(
			'name'=>'car_type',
			'type'=>'raw',
			'value'=>' CarModels::getCarTypes(!empty($data->car_type) ? $data->car_type : 0)',
			'filter'=>UsedCars::getCarTypes()
		),
		array(
			'header' => 'Запчастей в категории',
			'type' => 'html',
			'value' => 'Chtml::link($data->partsCount, Yii::app()->createUrl("/admin/parts", array("Parts" => array("car_model_id" => $data->id))))'
		),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}'
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("carmodels");', CClientScript::POS_END) ;?>