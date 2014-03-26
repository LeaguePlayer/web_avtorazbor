<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'client-modal',
    'header' => 'Информация о клиенте',
    'content' => $this->renderPartial('/clients/_form', array('model'=>$model, 'info' => $info, 'accounts' => $accounts, 'valid' => $valid), true),
    'footer' => array(
        // TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::button('Сохранить', array('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'class' => 'save-form', 'data-complete-text'=>'Сохранить')),
        TbHtml::button('Закрыть', array('data-dismiss' => 'modal')),
     ),
)); ?>
<script>
	jQuery('.save-form').on('click', function(){
		var $this = jQuery(this),
			$form = jQuery('.modal-block form');

		$this.button("loading");

		jQuery.ajax({
			url: '<?=$this->createUrl("clients/getClientForm", array("id" => $model->id))?>',
			type: 'post',
			data: $form.serialize()
		})
		.done(function(res){
			$this.button("complete");

			jQuery('#client-modal').modal('hide');
			jQuery('.modal-block').html(res);

			var $form = jQuery('#clients-form'),
				valid = $form.data('valid');

			console.log({id: $form.data('id'), text: $form.data('text')});
			if(valid){
				jQuery('#Requests_client_id').select2('data', {id: $form.data('id'), text: $form.data('text')});
				jQuery('#client-modal').modal('hide');
			}else
				jQuery('#client-modal').modal('show');

		});
	});
</script>