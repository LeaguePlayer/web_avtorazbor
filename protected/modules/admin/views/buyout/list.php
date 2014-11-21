<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'buyout-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('buyout')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		'car_brand.name',
		'car_model.name',
		array(
			'name'=>'year',
			'value'=>'UsedCars::getYears($data->year)',
			'filter'=>UsedCars::getYears(),

		),
		'capacity',
		array(
			'name'=>'transmission',

			'filter'=>UsedCarInfo::transmissionList(),
			'value'=>'UsedCarInfo::transmissionList($data->transmission)',
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Buyout::getStatusAliases($data->status)',
			'filter'=>Buyout::getStatusAliases()
		),
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("buyout");', CClientScript::POS_END) ;?>