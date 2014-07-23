<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->name,
);

<h1>View Country #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
