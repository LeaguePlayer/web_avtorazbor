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
        'question',
        'themeName',
        array(
            'label'=>'Статус',
            'type'=>'raw',
            'value'=>Questions::getStatusAliases($model->status),
        ),
        'create_time',
    ),
));
?>

            