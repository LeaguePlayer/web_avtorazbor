<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Письмо успещно отправлено.', array('id' => 'success', 'style' => 'display: none;')); ?>
<p>К автомобилю сформирован договор комиссии, вы можете выполнить следующие действия:</p>
<?php echo TbHtml::button('Отправить на почту', array(
	'loading' => 'Отправка...', 
	'data-complete-text'=> 'Отправить на почту',
	'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
	'data-id' => $model->document->id, 
	'class' => 'send-file')); 
?>&nbsp;
<?php echo TbHtml::link('Скачать', Yii::app()->createUrl('admin/documents/download', array('file' => $model->document->file))); ?>
<?php
Yii::app()->clientScript->registerScript('modalUsed3', '
jQuery("#usedCarModal").on("click", ".send-file", function(){
	var $this = jQuery(this);
	$this.button("loading");
	jQuery("#success").hide();

	jQuery.ajax({
		url: "/admin/documents/sendFile",
		data: {id: $this.data("id")},
		success: function(res){
			if(res == 1){
				jQuery("#success").show();
			}
			$this.button("complete");
		}
	});
});
', CClientScript::POS_READY);
?>