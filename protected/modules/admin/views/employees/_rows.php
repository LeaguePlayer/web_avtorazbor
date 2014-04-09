	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'post',array('class'=>'span8','maxlength'=>255)); ?>

	<div class="control-group">
		<label class="control-label" for="Locations_phone">Телефон</label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99'
			));?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?
	$show_extend = ($model->dt_birthday && $model->dt_birthday != '0000-00-00') || ($model->dt_of_issue && $model->dt_of_issue != '0000-00-00') || $model->passport_num || $model->issued_by || $model->address;

	$active = $show_extend ? ' active' : '';
	?>

	<div class="row">
		<div class="clearfix span8">
			<?php echo TbHtml::button('Расширенная анкета', array('style' => 'float: right;', 'class'=>'show-extended'.$active, 'toggle' => true, 'color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		</div>
	</div>

	<div id="ext" style="<? if(!$show_extend){?>display: none;<?}?>">
		<div class='control-group'>
			<?php echo CHtml::activeLabelEx($model, 'dt_birthday'); ?>
			<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
				'model' => $model,
				'attribute' => 'dt_birthday',
				'pluginOptions' => array(
					'format' => 'dd.MM.yyyy',
					'language' => 'ru',
	                'pickSeconds' => false,
	                'pickTime' => false
				)
			)); ?>
			<?php echo $form->error($model, 'dt_birthday'); ?>
		</div>

		<div class="control-group">
			<label class="control-label" for="Locations_phone">Номер паспорта</label>
			<div class="controls">
				<?php
				$this->widget('CMaskedTextField', array(
					'model' => $model,
					'attribute' => 'passport_num',
					'mask' => '9999 999999'
				));?>
			</div>
		</div>

		<?php echo $form->textAreaControlGroup($model,'issued_by',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<div class='control-group'>
			<?php echo CHtml::activeLabelEx($model, 'dt_of_issue'); ?>
			<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
				'model' => $model,
				'attribute' => 'dt_of_issue',
				'pluginOptions' => array(
					'format' => 'dd.MM.yyyy',
					'language' => 'ru',
	                'pickSeconds' => false,
	                'pickTime' => false
				)
			)); ?>
			<?php echo $form->error($model, 'dt_of_issue'); ?>
		</div>
	</div>
<script>
jQuery(".show-extended").on("click", function(){
	jQuery("#ext").toggle();
});
</script>