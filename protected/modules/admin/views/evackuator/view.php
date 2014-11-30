<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>


<?
	$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
        'phone',
        'mail',
        'Brand.name',
        'Model.name',
        'mass',
        'distance',
        'create_time',
    ),
));
?>

            