<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'clients-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('clients')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'fio',
		'phone',
		'email',
		array(
			'name' => 'type',
			'type' => 'raw',
			'value' => 'Clients::getTypes($data->type)',
			'filter' => Clients::getTypes()
		),
		array(
			'header' => 'Название компании',
			'type' => 'raw',
			'value' => '$data->type == Clients::CLIENT_UR ? $data->info->name_company : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("clients");', CClientScript::POS_END) ;?>