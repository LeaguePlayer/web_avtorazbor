<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Редактирование',
);

/*$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);*/
?>

<h1>Заявка № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>