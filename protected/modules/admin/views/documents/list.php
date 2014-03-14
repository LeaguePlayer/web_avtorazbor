<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'documents-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('documents')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(

		// 'name',		
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->name, Yii::app()->createUrl("admin/documents/download", array("file" => $data->file)))'
		),
		array(
			'name' => 'type',
			'type' => 'raw',
			'value' => '$data->getType()'
		),
		array(
			'name'=>'sum',
			'type'=>'raw',
			'value'=>'number_format($data->sum, 0, "", " ")'
		),
		// 'template_id',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'header' => '',
			'type' => 'html',
			'value' => 'Chtml::link("Скачать", Yii::app()->createUrl("/admin/documents/download", array("file" => $data->file)))'
		),
		array(
			'header' => '',
			'type' => 'raw',
			'value' => 'Chtml::link("Отправить на почту", "#sendEmail", array("data-id" => $data->id, "class" => "show-modal"))'
		),
		// array(
		// 	'name'=>'update_time',
		// 	'type'=>'raw',
		// 	'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		// ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update} {delete}'
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("documents");', CClientScript::POS_END) ;?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
	'id' => 'sendEmail',
	'header' => 'Форма отправки на e-mail',
	'content' => $this->renderPartial('_email_form', array(), true),
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
jQuery("#documents-grid").on("click", ".show-modal", function(){
	var $this = jQuery(this);
	jQuery("#sendEmail").modal("show");

	jQuery("#sendEmail .document-id").val($this.data("id"));
});

jQuery("#sendEmail").on("click", ".send-file", function(){
	var $this = jQuery(this),
		$form = jQuery("#modal-email-form");

	$this.button("loading");
	jQuery("#success, #error, #error2").hide();

	var email = jQuery(".user-email").val();

	if(email.length)
		jQuery.ajax({
			url: $form.attr("action"),
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