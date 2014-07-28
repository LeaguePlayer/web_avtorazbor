<?php
/* @var $this EvackuatorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evackuators',
);

$this->menu=array(
	array('label'=>'Create Evackuator', 'url'=>array('create')),
	array('label'=>'Manage Evackuator', 'url'=>array('admin')),
);
?>

<h1>Evackuators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
