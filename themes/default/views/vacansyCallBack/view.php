<?php
$this->breadcrumbs=array(
	'Vacansy Call Backs'=>array('index'),
	$model->id,
);

<h1>View VacansyCallBack #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fio',
		'phone',
		'email',
		'vacansy_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
