<?php
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'analogs-grid',
	'dataProvider'=>$analogs,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	//'filter' => (isset($filter) && $filter) ? $model : null,
	'rowHtmlOptionsExpression'=>'array(
        "data-analog"=>$data->id
    )',
	'columns'=>array(
		'id',
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->name, "/admin/parts/view/id/".$data->id)'
		),
		'price_sell',
		array(
			'name'=>'category_id',
			'type'=>'raw',
			'value'=>'$data->category->name'
		),
		array(
			'name'=>'car_model_id',
			'type'=>'raw',
			'value'=>'$data->car_model->car_brand->name." ".$data->car_model->name'
		),
		// array(
		// 	'class'=>'bootstrap.widgets.TbButtonColumn',
		// ),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		    'template'=>'{delete}',
		    'buttons'=>array(
		        'delete' => array(
		            // 'imageUrl'=> TbHtml::icon(TbHtml::ICON_REMOVE),
		            'url'=>'#',
		            'click'=>"function(e){
						e.preventDefault();

						// var analog = jQuery(this).closest('tr').data('analog');

						// jQuery.ajax({
						// 	url: '/admin/parts/deleteAnalog',
						// 	type: 'POST',
						// 	data: {id: analog, part: ".$model->id."},
						// 	success: function(){
						// 		jQuery.fn.yiiGridView.update('analogs-grid');

						// 		var values = jQuery('#Analogs').select2('val');
						// 		var temp = [];

						// 		for(v in values){
						// 			if(values[v] != analog) temp.push(values[v]);
						// 		}
						// 		jQuery('#Analogs').select2('val', temp);
						// 	}
						// });
		            }",
		            // 'options' => array('data-analog' => $data->id)
		        )
		    ),
		)*/
	),

)); ?>