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
	    array(
	    	'label'=>'Автомобиль',
	    	'type'=>'raw',
	    	'value'=>CHtml::link($model->car->name,
	    		Yii::app()->createUrl("/admin/usedCars/update",array("id"=>$model->car->id))),
	    ),
	    array(
	    	'label'=>'Артикул Авто',
	    	'type'=>'raw',
	    	'value'=>CHtml::link($model->car->id.' - Пререйти ',
	    		Yii::app()->createUrl("/admin/usedCars/update",array("id"=>$model->car->id))),
	    ),
	    // array(
	    // 	'label'=>'Статус',
	    // 	'type'=>'raw',
	    // 	'value'=>Parts::getStatusAliases($model->status)
	    // ),
    ),
));
?>

            