<?php
$this->breadcrumbs=array(
	'Evackuators'=>array('index'),
	$model->name,
);

<h1>View Evackuator #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'mail',
		'brand',
		'car_model_id',
		'mass',
		'distance',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
