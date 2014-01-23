<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'used-cars-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('usedcars')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name' => 'car_model_id',
			'type' => 'raw',
			'value' => '$data->model->car_brand->name." ".$data->model->name'
		),
		'vin',
		'price',
		'comment',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'UsedCars::getStatusAliases($data->status)',
			'filter'=>UsedCars::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("usedcars");', CClientScript::POS_END) ;?>