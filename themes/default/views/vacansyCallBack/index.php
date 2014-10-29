<?php
/* @var $this VacansyCallBackController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vacansy Call Backs',
);

$this->menu=array(
	array('label'=>'Create VacansyCallBack', 'url'=>array('create')),
	array('label'=>'Manage VacansyCallBack', 'url'=>array('admin')),
);
?>

<h1>Vacansy Call Backs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
