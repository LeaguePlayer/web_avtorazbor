<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php echo TbHtml::buttonDropdown('Действия', array(
    array('label' => 'Отправить оп почте', 'url' => '#', 'class' => 'show-modal'),
    array('label' => 'Скачать excel файл', 'url' => '/admin/parts/toExcel'),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'parts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('parts')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'name',
		'price_sell',
		'price_buy',
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
		array(
			'name'=>'location_id',
			'type'=>'raw',
			'value'=>'$data->location->name'
		),
		// 'client_id',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Parts::getStatusAliases($data->status)',
			'filter'=>Parts::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("parts");', CClientScript::POS_END) ;?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
	'id' => 'sendEmail',
	'header' => 'Форма отправки на e-mail',
	'content' => $this->renderPartial('/documents/_email_form', array(), true),
	'footer' => array(
		TbHtml::button('Отправить на почту', array(
			'loading' => 'Отправка...', 
			'data-complete-text' => 'Отправить на почту',
			'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
			// 'data-id' => $model->document->id,
			'class' => 'send-file')
		),
		TbHtml::button('Закрыть', array('class' => 'close-email-modal', 'data-dismiss' => 'modal'))
	),
));

?>
<?php
Yii::app()->clientScript->registerScript('modal', '
jQuery(".show-modal").on("click", function(){
	var $this = jQuery(this);
	jQuery("#sendEmail").modal("show");
});

jQuery("#sendEmail").on("click", ".send-file", function(){
	var $this = jQuery(this),
		$form = jQuery("#modal-email-form");

	$this.button("loading");
	jQuery("#success, #error, #error2").hide();

	var email = jQuery(".user-email").val();

	if(email.length)
		jQuery.ajax({
			url: "/admin/parts/sendExcel",
			type: "post",
			data: $form.serialize(),
			success: function(res){
				if(res != 0){
					jQuery("#success").show();
				}else
					jQuery("#error2").show();
				$this.button("complete");
			}
		});
	else{
		jQuery("#error").show();
		$this.button("complete");
	}
});
', CClientScript::POS_READY);
?>