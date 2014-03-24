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

<h3>Шаг 1 из 3 (<?=$model->getAttributeLabel('status')?>: <?php echo CHtml::encode(Requests::getStatusAliases($model->status)); ?>)</h3>

<?php echo $this->renderPartial('step1/_form',array('model'=>$model)); ?>