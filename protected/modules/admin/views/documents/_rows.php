	<?php echo $form->dropDownListControlGroup($model,'used_car_id', CHtml::listData(UsedCars::toBuyAll(), 'id', 'nameVin')); ?>

	<?php
	$checked = $model->type == Documents::DOC_KUPLI_I_PROD_BU_WITH_KOMISSII ? true : false;
	$disabled = !$model->isNewRecord ? true : false;
	?>

	<?php echo TbHtml::checkBoxControlGroup('with_doc_komissii', $checked, array('label' => 'На основании договора комиссии', 'disabled' => $disabled)); ?>

	<?php //echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'used_car_id',array('class'=>'span8')); ?>

	<?php //echo $form->textFieldControlGroup($model,'template_id',array('class'=>'span8')); ?>

<!-- client -->

<fieldset>
	<legend>Данные нового владельца</legend>
	<?php echo $form->textFieldControlGroup($client,'fio',array('class'=>'span8','maxlength'=>255)); ?>
	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($client, 'dt_birthday'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'id' => 'client_dt_birthday',
			'model' => $client,
			'attribute' => 'dt_birthday',
			'pluginOptions' => array(
				'format' => 'dd.MM.yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			),
			'htmlOptions' => array(
				'value' => ($client->dt_birthday && $client->dt_birthday != '0000-00-00') ? SiteHelper::formatDate($client->dt_birthday, 'Y-m-d', 'd.m.Y') : ''
			)
		)); ?>
		<?php echo $form->error($client, 'dt_birthday'); ?>
	</div>
	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($client, 'passport_num'); ?>
		<?php
			$this->widget('CMaskedTextField', array(
			'model' => $client,
			'attribute' => 'passport_num',
			'mask' => '9999 999999'));
		?>
		<?php echo $form->error($client, 'passport_num'); ?>
	</div>
	<?php echo $form->textAreaControlGroup($client,'issued_by',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($client,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($client, 'dt_of_issue'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'id' => 'client_dt_of_issue',
			'model' => $client,
			'attribute' => 'dt_of_issue',
			'pluginOptions' => array(
				'format' => 'dd.MM.yyyy',
				'language' => 'ru',
                'pickSeconds' => false,
                'pickTime' => false
			),
			'htmlOptions' => array(
				'value' => ($client->dt_of_issue && $client->dt_of_issue != '0000-00-00') ? SiteHelper::formatDate($client->dt_of_issue, 'Y-m-d', 'd.m.Y') : ''
			)
		)); ?>
		<?php echo $form->error($client, 'dt_of_issue'); ?>
	</div>

	<div class="control-group">
		<label class="control-label" for="Clients_email"><?=$client->getAttributeLabel('phone')?></label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $client,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
			));
			?>
		</div>
	</div>
</fieldset>