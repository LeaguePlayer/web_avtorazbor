<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
);
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>

<?
	$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'fio',             // title attribute (in plain text)
        'phone',        // an attribute of the related object "owner"
        'email',        // an attribute of the related object "owner"
        'vacansy.post',  // description attribute in HTML
        'comment',  // description attribute in HTML
    ),
));
?>
