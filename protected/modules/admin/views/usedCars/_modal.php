<p>К автомобилю сформирован договор комиссии, вы можете выполнить следующие действия:</p>
<?php /*echo TbHtml::button('Отправить на почту', array(
	'loading' => 'Отправка...', 
	'data-complete-text'=> 'Отправить на почту',
	'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
	'data-id' => $model->document->id, 
	'class' => 'send-file'));*/
	echo TbHtml::link('Отправить на почту', '#', array('class' => 'open-email-modal', 'data-id' => $model->document->id));
?>&nbsp;
<?php echo TbHtml::link('Скачать', Yii::app()->createUrl('admin/documents/download', array('file' => $model->document->file))); ?>
<?php
Yii::app()->clientScript->registerScript('modalUsed3', '

jQuery(".open-email-modal").on("click", function(){
	jQuery("#usedCarModal").modal("hide");
	jQuery("#sendEmail").modal("show");

	jQuery("#sendEmail .document-id").val(jQuery(this).data("id"));
});

jQuery("#sendEmail").on("click", ".close-email-modal", function(){
	jQuery("#sendEmail").modal("hide");
	jQuery("#usedCarModal").modal("show");
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