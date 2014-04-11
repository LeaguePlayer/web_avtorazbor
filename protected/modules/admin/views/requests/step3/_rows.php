	<div class="clients" data-client-id="<?=$model->client_id?>">
		<div class="control-group">
			<?=$form->labelEx($model, 'client_id')?>
			<div class="controls">
				<?=$model->client->type == 1 ? $model->client->fio : $model->client->info->name_company ?>
			</div>
		</div>
	</div><br>
	<div class="control-group">
		<?=$form->labelEx($model, 'check_user_id')?>
		<div class="controls" data-url= "<?=Yii::app()->createUrl("admin/employees/addTag")?>">
			<?=$model->employee ? $model->employee->fio : 'Нет' ?>
		</div>
	</div><br>
	<div class="utilization">
		<?if(isset($_POST['Utilization'])):?>
			<?foreach ($_POST['Utilization'] as $id):?>
				<div class="part-<?=$id?>"><input type="hidden" name="Utilization[]" value='<?=$id?>'></div>
			<? endforeach; ?>
		<?endif;?>
	</div>
	<div class="requests" data-request-id="<?=$model->id?>">
		<div class="row-fluid">
			<div class="span10">
				<table class="table">
					<thead>
						<tr>
							<th>№ Позиции</th>
							<th>Название</th>
							<th>Склад</th>
							<th>Цена</th>
						</tr>
					</thead>
					<tbody class="parts-update">
						<? $this->renderPartial('step3/_body_parts', array('model' => $model)); ?>
					</tbody>
					<?=TbHtml::activeHiddenField($model, 'id', array('ng-model' => 'request', 'ng-init' => "request_id='".$model->id."'"))?>
				</table>
			</div>
		</div>
	</div>

	<div class="documents">
		<h3>Какие документы Вам нужны по данной заявке?</h3>
		<ul>
			<?foreach ($model->documents as $document):?>
			<li><?=CHtml::link($document->getType(), $this->createUrl('documents/download', array('file' => $document->file)))?></li>
			<?endforeach;?>
		</ul>
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
		var part_id = parseInt(jQuery('#new_part').select2('val'), 10),
			req_id = jQuery('.requests').data('request-id');

		if(req_id && part_id && typeof part_id === 'number'){
			jQuery('.utilization').find('.part-'+part_id).remove();
			jQuery.ajax({
				url: '<?=$this->createUrl("addPart")?>',
				data: {request_id: req_id, part_id: part_id},
				success: function(data){
					jQuery('.parts-update').html(data);
				}
			});
		}
	});

	//remove part from request
	jQuery('.requests').on('click', '.remove-part', function(){
		var part_id = jQuery(this).data('id'),
			req_id = jQuery('.requests').data('request-id');

		if(req_id && part_id && typeof part_id === 'number'){
			jQuery('.utilization').append('<div class="part-'+part_id+'"><input type="hidden" name="Utilization[]" value="'+part_id+'"></div>')
			jQuery.ajax({
				url: '<?=$this->createUrl("deletePart")?>',
				data: {request_id: req_id, part_id: part_id},
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