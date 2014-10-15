<?php
$this->breadcrumbs=array(
	'Buyouts'=>array('index'),
	$model->name,
);

<h1>View Buyout #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'email',
		'brand',
		'modelName',
		'year',
		'capacity',
		'transmission',
		'comment',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
