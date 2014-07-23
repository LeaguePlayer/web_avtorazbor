<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'used-cars-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('usedcars')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		array(
			'name' => 'car_model_id',
			'type' => 'html',
			'value' => 'CHtml::link($data->model->car_brand->name." ".$data->model->name, Yii::app()->createUrl("admin/usedCars/update", array("id" => $data->id)))'
		),
		'year',
		array(
			'header' => 'Тип машины',
			'type' => 'raw',
			'value' => '$data->type==1 ? "Легковая" : "Грузовая"',
		),
		array(
			'header' => 'Цвет',
			'type' => 'raw',
			'value' => '$data->dop->color'
		),
		'vin',
		'price',
		array(
			'header' => 'Тип КПП',
			'type' => 'raw',
			'value' => '$data->dop->getTransmissionType()'
		),
		'comment',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'UsedCars::getStatusAliases($data->status)',
			'filter'=>UsedCars::getStatusAliases()
		),
		array(
			'name' => 'enter_date',
			'type' => 'raw',
			'value' => 'SiteHelper::formatDate($data->enter_date, "Y-m-d", "d.m.Y")'
		),
		array(
			'header' => '',
			'type' => 'raw',
			'value' => function ($data, $row){
				$list_url = "admin/parts/list"; 
				
				if($data->status == 1){ //На запчасти
					$params = array("Parts" => array("usedCar" => $data->id));
					return CHtml::link("Посмотреть запчасти", Yii::app()->createUrl($list_url, $params));
				}

				$params = array("Parts" => array("car_model_id" => $data->car_model_id));

				return CHtml::link("Посмотреть запчасти", Yii::app()->createUrl($list_url, $params));
			}
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}'
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("usedcars");', CClientScript::POS_END) ;?>