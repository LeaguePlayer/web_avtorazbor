<h1>Просмотр заявки № <?=$model->id?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'request-logs',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->textAreaControlGroup($requestSave,'message', array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<?php echo $form->hiddenField($requestSave,'type', array('class' => 'event-type')); ?>

<?php 

$icons = array(
	RequestLogs::RL_PHONE => $this->getAssetsUrl().'/images/log_icons/phone.png'
);

$buttons = array(
	array('label' => 'Сохранить', 'color' => TbHtml::BUTTON_COLOR_SUCCESS, 'data-type' => RequestLogs::RL_COMMENT),
	array('label' => TbHtml::image($icons[RequestLogs::RL_PHONE], '', array('style' => 'height: 16px')).' Позвонил', 'color' => TbHtml::BUTTON_COLOR_WARNING, 'data-type' => RequestLogs::RL_PHONE)
);

echo TbHtml::buttonGroup($buttons, array('id' => 'button-types')); ?>

<?php $this->endWidget(); ?>

<div class="row-fluid">
	<div class="span10">
		<fieldset>
			<legend>Журнал</legend>
			<?php $this->widget('bootstrap.widgets.TbGridView', array(
				'dataProvider' => $dataProvider,
				// 'type' => TbHtml::GRID_TYPE_STRIPED,
				'template' => "{items}",
				'filter' => $requestLog,
				'columns' => array(
					array(
						'header'=>'Артикул',
						'type' => 'raw',
						'value'=>'$data->id'
					),
					array(
						'name' => 'user_id',
						'type' => 'raw',
						'value' => '$data->user_id == 0 ? "Планировщик задач" : $data->getUserName()',
						'filter' => false
					),
					array(
						'name' => 'type',
						'type' => 'raw',
						'value' => 'RequestLogs::types($data->type)',
						'filter' => RequestLogs::types()
					),
					array(
						'name' => 'message',
						'type' => 'raw',
						'value' => '$data->message'
					),
					array(
						'header' => 'Дата',
						'type' => 'raw',
						'value' => 'date("d.m.Y H:i", strtotime($data->create_time))'
					),
				),
			)); ?>
		</fieldset>
	</div>
</div>
<script>
$('#button-types a').on('click', function(e){
	e.preventDefault();

	var $this = $(this)
		type = $(this).data('type');

	$('.event-type').val(type);

	$('#request-logs').submit();
});
</script>