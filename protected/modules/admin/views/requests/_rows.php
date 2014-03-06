	<div class="clients">
		<div class="control-group">
			<label class="control-label" for="Requests_check_user_id"><?=$model->getAttributeLabel('client_id')?></label>
			<div class="controls">
				<?php //print_r(Clients::getList()); ?>
				<?php /*$this->widget('bootstrap.widgets.TbTypeAhead', array(
					// 'model' => $model,
					// 'attribute' => 'client_id',
					'name' => $model->getAttributeLabel('client_id'),
					'source' => Clients::getList(),
					// 'source' => array('sadf', 'asdf'),
				)); */?>
				<?php 
					$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => false,
					'model' => $model,
					'attribute' => 'client_id',
					// 'data' => Clients::getList(),
					// 'name' => 'select2test',
					'pluginOptions' => array(
					    // 'placeholder' => 'type 2amigos',
					    'maximumSelectionSize' => 1,
					    'tags' => Clients::getList(),
					    'width' => '40%',
					    'formatSelectionTooBig' => 'js:function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}'
					    // 'query' => 'js:function(){

					    // }'
					    // 'tokenSeparators' => array(',', ' ')
					)));
				?><br><br>
				<div class="actions-yes" style="display: none;">
					<?php echo TbHtml::button('Посмотреть данные', array(
						'style' => TbHtml::BUTTON_COLOR_PRIMARY,
						'size' => TbHtml::BUTTON_SIZE_SMALL,
						'data-toggle' => 'modal',
						'data-target' => '#client-modal',
					)); ?>
				</div>
				<div class="actions-no" style="display: none;">
					<?php echo TbHtml::button('Заполнить данные', array(
						'style' => TbHtml::BUTTON_COLOR_PRIMARY,
						'size' => TbHtml::BUTTON_SIZE_SMALL,
						'data-toggle' => 'modal',
						'data-target' => '#client-modal',
					)); ?>
				</div>
			</div>
		</div>
		<? $this->renderPartial('/clients/_request_form', array('model' => $model->client, 'form' => $form)); ?>
	</div>


	<?php echo $form->textFieldControlGroup($model,'check_user_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model,'from', Requests::getFromList()); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Requests::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<div class="modal-block"></div>
<script>
	jQuery('#Requests_client_id').on('selected', function(e){
		var val = parseInt(e.val, 10);

		if(typeof val === 'number' && !isNaN(val)){ //Клиент существует
			jQuery.ajax({
				url: '<?=$this->createUrl("clients/getClientForm")?>',
				data: {id: val},
				success: function(data){
					jQuery('.modal-block').html(data);
					jQuery('.actions-no').hide();
					jQuery('.actions-yes').show();
				}
			});
		}else{ // Не существует
			jQuery.ajax({
				url: '<?=$this->createUrl("clients/getClientForm")?>',
				data: {name: e.val},
				success: function(data){
					jQuery('.modal-block').html(data);
					jQuery('.actions-yes').hide();
					jQuery('.actions-no').show();
				}
			});
		}
	});
</script>