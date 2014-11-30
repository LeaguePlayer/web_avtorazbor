<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bookpart-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('bookpart')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'name',
			'type' => 'html',
			'value' => 'CHtml::link($data->name, Yii::app()->createUrl("admin/bookpart/update", array("id" => $data->id)))'
		),
		'phone',
		'mail',
		'vin',
		'parts',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>' !empty($data->status) ? Bookpart::getStatusAliases($data->status) : Bookpart::getStatusAliases(0)',
			'filter'=>Bookpart::getStatusAliases()
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

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("bookpart");', CClientScript::POS_END) ;?>