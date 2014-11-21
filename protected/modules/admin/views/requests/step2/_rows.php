	<div class="clients" data-client-id="<?=$model->client_id?>">
		<div class="control-group">
			<?=$form->labelEx($model, 'client_id')?>
			<div class="controls">
				<?php
					$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'asDropDownList' => false,
					'model' => $model,
					'attribute' => 'client_id',
					'pluginOptions' => array(
					    'maximumSelectionSize' => 1,
					    'tags' => Clients::getList(),
					    'width' => '40%',
					    'formatSelectionTooBig' => 'js:function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}'
					)));
				?><br><br>
				<div class="actions-yes" style="<?if(!$model->client_id):?>display: none;<?endif;?>">
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
		<div class="control-group">
			Данные заказчика
			<div class="control-grop">
				<?=$form->labelEx($model,'fio')?>
				<?=$form->textField($model,'fio')?>
			</div>
			<div class="control-grop">
				<?=$form->labelEx($model,'phone')?>
				<?=$form->textField($model,'phone')?>
			</div>
			<div class="control-grop">
				<?=$form->labelEx($model,'email')?>
				<?=$form->textField($model,'email')?>
			</div>
			<div class="control-grop">
				<?=$form->labelEx($model,'delivery')?>
				<?=$form->dropDownList($model,'delivery',Requests::getDeliveryType(),array('empty'=>'Не определено!'))?>
			</div>
			<div class="control-grop">
				<?=$form->labelEx($model,'city')?>
				<?=$form->textField($model,'city')?>
			</div>
			<div class="control-grop">
				<?=$form->labelEx($model,'adress')?>
				<?=$form->textField($model,'adress')?>
			</div>
		</div>
	</div><br>
	<div class="control-group">
		<?=$form->labelEx($model, 'check_user_id')?>
		<div class="controls" data-url= "<?=Yii::app()->createUrl("admin/employees/addTag")?>">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'check_user_id',
				'asDropDownList' => false,
				'pluginOptions' => array(
					'maximumSelectionSize' => 1,
					'formatSelectionTooBig' => 'js:function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}',
					'tags' => Employees::getListForSelect(),
				    'width' => '40%',
				),
				'htmlOptions' => array(
				)));
			?>
		</div>
	</div><br>
	<div class="utilization">
		<?if(isset($_POST['Utilization'])):?>
			<?foreach ($_POST['Utilization'] as $id):?>
				<div class="part-<?=$id?>"><input type="hidden" name="Utilization[]" value='<?=$id?>'></div>
			<? endforeach; ?>
		<?endif;?>
	</div>
	<div class="control-group">
		<?=$form->label($model, 'date_life')?>
		<div class="controls">
			<?php 
			$date = new DateTime($model->date_life);
			echo CHtml::encode($date->format('d.m.Y H:i')); ?>
		</div>
	</div>
	<div class="requests" data-request-id="<?=$model->id?>">
		<div class="row-fluid">
			<div class="span10">
				<table class="table">
					<thead>
						<tr>
							<th>№ Позиции</th>
							<th>Артикул</th>
							<th>Название</th>
							<th>Склад</th>
							<th>Статус</th>
							<th>Цена</th>
						</tr>
					</thead>
					<tbody class="parts-update">
						<? $this->renderPartial('step2/_body_parts', array('model' => $model)); ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">
							<?php
								$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
									'name' => 'new_part',
									'asDropDownList' => false,
									'pluginOptions' => array(
										'width' => '100%',
										'ajax' => array(
											'url' => '/admin/parts/allJson',
											'dataType' => 'json',
											'quietMillis' => 300,
											'data' => 'js: function(term, page){var req_id = jQuery(".requests").data("request-id"); return {q: term, req_id: req_id};}',
											'results' => 'js: function(data, page){return { results: data };}'
										)
									)
								));
							?>
							<div class="clearfix">&nbsp;</div>
							</td>
							<td colspan="1"><?=TbHtml::button('Добавить', array('class' => 'add-part'))?></td>
							<td colspan="2"></td>
						</tr>
					</tfoot>
					<?=TbHtml::activeHiddenField($model, 'id', array('ng-model' => 'request', 'ng-init' => "request_id='".$model->id."'"))?>
				</table>
			</div>
		</div>
	</div>

	<div class="modal-block"></div>
<script>
	jQuery(document).ready(function(){
		var client_id = jQuery('.clients').data('client-id');

		if(typeof client_id === 'number' && !isNaN(client_id)){
			jQuery.ajax({
				url: '<?=$this->createUrl("clients/getClientForm")?>',
				data: {id: client_id},
				success: function(data){
					jQuery('.modal-block').html(data);
				}
			});
		}
	});
	jQuery('#Requests_client_id').on('removed', function(){
		jQuery('.actions-no, .actions-yes').hide();
	});
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

	//add part to request
	jQuery('.add-part').on('click', function(){
		var part_id = parseInt(jQuery('#new_part').val(), 10),
			req_id = parseInt(jQuery('.requests').data('request-id'), 10);

		if(req_id && part_id && typeof part_id === 'number'){
			jQuery('.utilization').find('.part-'+part_id).remove();
			jQuery.ajax({
				url: '<?=$this->createUrl("addPart")?>',
				data: {request_id: req_id, part_id: part_id, step: 2},
				success: function(data){
					jQuery('.parts-update').html(data);
				}
			});
		}
	});

	//remove part from request
	jQuery('.requests').on('click', '.remove-part', function(){
		var part_id = parseInt(jQuery(this).data('id'), 10),
			req_id = parseInt(jQuery('.requests').data('request-id'), 10);

		if(req_id && part_id && typeof part_id === 'number'){
			jQuery('.utilization').append('<div class="part-'+part_id+'"><input type="hidden" name="Utilization[]" value="'+part_id+'"></div>')
			jQuery.ajax({
				url: '<?=$this->createUrl("deletePart")?>',
				data: {request_id: req_id, part_id: part_id, step: 2},
				success: function(data){
					jQuery('.parts-update').html(data);
				}
			});
		}
	});

	//add employee
	jQuery("#Requests_check_user_id").on("selected",function(e){
		var $this = jQuery(this),
			val = parseInt(e.val, 10);

		if(isNaN(val)){
			jQuery.ajax({
				url: $this.closest(".controls").data("url"),
				data: {Tag: e.val},
				type: "POST",
				dataType: "json"
			}).done(function(res){
				if(res.id.length && res.data.length){
					var v = $this.val();
					$this.val(v.replace(e.val, res.id));
					$this.select2({
						tags: res.data, 
						width:"40%", 
						maximumSelectionSize: 1,
						formatSelectionTooBig: function(maxSize){return "Вы можете выбрать только "+maxSize+" значение.";}
					}).trigger("change");
				}
			});
		}
	});
</script>
<?php 
/*$cs = Yii::app()->clientScript;
$cs->registerScriptFile($this->getAssetsUrl().'/js/angular/angular.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->getAssetsUrl().'/js/requests/controller.js', CClientScript::POS_END);*/
?>