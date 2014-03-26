<?php
$this->menu=array(
	array('label'=>'Сформировать','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>
<div class="requests-grid">
	<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'requests-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type'=>TbHtml::GRID_TYPE_HOVER,
	    'afterAjaxUpdate'=>"function() {sortGrid('requests')}",
	    'rowHtmlOptionsExpression'=>'array(
	        "id"=>"items[]_".$data->id,
	        "class"=>"status_".(isset($data->status) ? $data->status : ""),
	        "data-id"=>$data->id,
	    )',
		'columns'=>array(
			'id',
			array(
				'name'=>'client_id',
				'type'=>'raw',
				'value'=>'$data->client ? ($data->client->type == 2 ? $data->client->info->name_company : $data->client->fio) : ""'
			),
			// 'check_user_id',
			array(
				'name'=>'from',
				'type'=>'raw',
				'value'=>'$data->getFrom()',
				'filter'=>Requests::getFromList()
			),
			array(
				'name'=>'status',
				'type'=>'raw',
				'value'=>'CHtml::activeDropDownList($data, "status", Requests::getStatusAliases(), array("class" => "change-status", "data-req-id" => $data->id))',
				'filter'=>Requests::getStatusAliases()
			),
			array(
				'name'=>'create_time',
				'type'=>'raw',
				'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
			),
			array(
				'name'=>'update_time',
				'type'=>'raw',
				'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
			),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	)); ?>
</div>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("requests");', CClientScript::POS_END) ;?>
<script>
	jQuery(".requests-grid").on('change', '.change-status', function(){
		var $this = jQuery(this);
		var req_id = $this.data('req-id'),
			val = $this.val();

		jQuery.ajax({
			url: '<?=$this->createUrl("change")?>',
			data: {id: req_id, status: val},
			success: function(){
				jQuery('#requests-grid').yiiGridView('update');
			}
		});
	});
</script>