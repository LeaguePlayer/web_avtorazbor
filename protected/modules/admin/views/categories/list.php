<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Парсер','url'=>array('parse')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'category-grid',
	'dataProvider'=>$data,
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('category')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'header' => '',
			'type' => 'raw',
			'value' => '$data->parent==0 ? CHtml::link(TbHtml::icon(TbHtml::ICON_PLUS), "#", array("class" => "show-sub", "data-id" => $data->id)) : ""'
		),
		array(
			'name' => 'name',
			'type' => 'html',
			'value' => '$data->cat_parent ? "&emsp;".$data->name : "<strong>".$data->name."</strong>"'
		),
		array(
			'header' => 'Запчастей в категории',
			'type' => 'html',
			'value' => 'Chtml::link($data->partsCount, Yii::app()->createUrl("/admin/parts", array("Parts" => array("category_id" => $data->id))))'
		),
		/*array(
			'name' => 'parent',
			'value' => '$data->cat_parent ? $data->cat_parent->name : "Корневая категория"'
		),*/
		// 'sort',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("category");', CClientScript::POS_END) ;?>

<script>
	jQuery('#main-content').on('click', '.show-sub', function(){
		var id = jQuery(this).data('id');

		jQuery('#category-grid').yiiGridView('update', {
			type: 'GET',
			url: "",
			data: {show: id},
			success: function(data) {

			},
			error: function(XHR) {
				
			}
		});
	});
</script>