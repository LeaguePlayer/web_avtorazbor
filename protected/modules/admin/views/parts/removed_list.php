<?php
// $this->menu=array(
// 	array('label'=>'Добавить','url'=>array('create')),
// );
?>

<h1>Корзина</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'parts-grid',
	'dataProvider'=>$data,
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {
    	sortGrid('parts');
    	jQuery('#Parts_car_model_id').select2({'width':'150px','ajax':{'url':'/admin/carModels/allJson','dataType':'json','data': function(term, page){return {q: term};},'results': function(data, page){return { results: data };}},'initSelection':function (element, callback) {var id=$(element).val(); $.getJSON('/admin/carModels/getOneById', {id: id}, function(data) { callback(data); }) }});
    	jQuery('#Parts_category_id').select2({'width':'150px','ajax':{'url':'/admin/categories/allJson','dataType':'json','data': function(term, page){return {q: term};},'results': function(data, page){return { results: data };}},'initSelection':function (element, callback) {var id=$(element).val(); $.getJSON('/admin/categories/getOneById', {id: id}, function(data) { callback(data); }) }});

    	//filter
    	var \$filter = jQuery('.filters').find('input, select');
    	jQuery('.get-file a').attr('href', '/admin/parts/toExcel?' + \$filter.serialize());
    }",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'id',
		array(
			'header' => 'Фото',
			'type' => 'html',
			'value' => '$data->gallery->main ? TbHtml::imageRounded($data->gallery->main->getPreview(), "", array("width"=> 120)) : ""'
		),
		'name',
		'price_sell',
		array(
			'name'=>'location_id',
			'type'=>'raw',
			'value'=>'$data->location ? $data->location->name : ""',
			'filter'=> SiteHelper::getDDListForModel($model, 'Locations', 'location_id')
		),
		'comment',
		/*array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),*/
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'TbHtml::dropDownList("status".$data->id, $data->status, Parts::getStatusAliases(), array("class" => "change-status", "data-id" => $data->id))',
			'filter'=>Parts::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{delete}',
			'deleteConfirmation' => 'Удалить навсегда?',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("parts");', CClientScript::POS_END) ;?>

<script>
	jQuery('#parts-grid').on('change', '.change-status', function(){
		var $this = $(this);

		jQuery.ajax({
			url: '<?=$this->createUrl("changeStatus")?>/id/' + $this.data('id'),
			type: "POST",
			data: {val: $this.val()},
			success: function(){
				jQuery('#parts-grid').yiiGridView('update');
			}
		});
	});
</script>