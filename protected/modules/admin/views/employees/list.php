<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'employees-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('employees')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'fio',
		'phone',
		'email',
		'post',
		array(
			'name'=>'dt_birthday',
			'type'=>'raw',
			'value'=>'$data->dt_birthday && $data->dt_birthday != "0000-00-00" ? SiteHelper::russianDate($data->dt_birthday) : ""'
		),
		'passport_num',
		array(
			'name'=>'dt_of_issue',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dt_of_issue)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}'
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("employees");', CClientScript::POS_END) ;?>