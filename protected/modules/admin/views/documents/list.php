<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'documents-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('documents')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(

		// 'name',		
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->name, Yii::app()->createUrl("admin/documents/download", array("file" => $data->file)))'
		),
		array(
			'name' => 'type',
			'type' => 'raw',
			'value' => '$data->getType()'
		),
		array(
			'name'=>'sum',
			'type'=>'raw',
			'value'=>'number_format($data->sum, 0, "", " ")'
		),
		// 'template_id',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		// array(
		// 	'name'=>'update_time',
		// 	'type'=>'raw',
		// 	'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		// ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("documents");', CClientScript::POS_END) ;?>