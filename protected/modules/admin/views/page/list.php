<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Контент разделов','url'=>array('list?system=true')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>
<?
	$dataProvider=$model->search();
	$dataProvider->criteria->addCondition('status'.(isset($_GET['system']) ? '=':'!=').'4');
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'page-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('page')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->name,"/admin/page/update/id/".$data->id)',
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Page::getStatusAliases($data->status)',
			'filter'=>Page::getStatusAliases()
		),
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("page");', CClientScript::POS_END) ;?>