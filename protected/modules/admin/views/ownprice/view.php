<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Просмотр',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
);
?>

<h1><?php echo $model->translition(); ?> - просмотр</h1>


<?
	$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
	    'phone',
	    'mail',
	    'own_price',
	    'car.name',
	    array(
	    	'label'=>'Артикул Авто',
	    	'type'=>'raw',
	    	'value'=>$model->car->id,
	    ),
	    'status',
    ),
));
?>

            