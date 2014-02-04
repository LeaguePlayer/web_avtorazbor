<?php
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'analogs-grid',
	'dataProvider'=>$analogs->search_analogs($model->id),
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'rowHtmlOptionsExpression'=>'array(
        "data-analog"=>$data->id
    )',
	'columns'=>array(
		'name',
		'price_sell',
		'category_id',
		'car_model_id',
		// array(
		// 	'class'=>'bootstrap.widgets.TbButtonColumn',
		// ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		    'template'=>'{delete}',
		    'buttons'=>array(
		        'delete' => array(
		            // 'imageUrl'=> TbHtml::icon(TbHtml::ICON_REMOVE),
		            'url'=>'#',
		            'click'=>"function(e){
		            	e.preventDefault();

		            	var analog = jQuery(this).closest('tr').data('analog');

		            	jQuery.ajax({
							url: '/admin/parts/deleteAnalog',
							type: 'POST',
							data: {id: analog, part: ".$model->id."},
							success: function(){
								jQuery.fn.yiiGridView.update('analogs-grid');

								var values = jQuery('#Analogs').select2('val');
								var temp = [];

								for(v in values){
									if(values[v] != analog) temp.push(values[v]);
								}
								jQuery('#Analogs').select2('val', temp);
							}
						});
		            }",
		            // 'options' => array('data-analog' => $data->id)
		        )
		    ),
		)
	),

)); ?>