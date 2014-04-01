	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Clients_email"><?=$model->getAttributeLabel('phone')?></label>
		<div class="controls">
			<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array('class' => 'span8')
			));
			?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?php

		$show_extend = ($model->dt_birthday && $model->dt_birthday != '0000-00-00') || ($model->dt_of_issue && $model->dt_of_issue != '0000-00-00') || $model->passport_num || $model->issued_by || $model->address;

		$active = $show_extend ? ' active' : '';
	?>

	<div class="row">
		<div class="clearfix span8">
			<?php echo TbHtml::button('Расширенная анкета', array('style' => 'float: right;', 'class'=>'show-extended'.$active, 'toggle' => true, 'color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		</div>
	</div>

	<!-- extended -->
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
				),
				'htmlOptions' => array(
					'value' => ($model->dt_birthday && $model->dt_birthday != '0000-00-00') ? SiteHelper::formatDate($model->dt_birthday, 'Y-m-d', 'd.m.Y') : ''
				)
			)); ?>
			<?php echo $form->error($model, 'dt_birthday'); ?>
		</div>

		<div class='control-group'>
			<?php echo CHtml::activeLabelEx($model, 'passport_num'); ?>
			<?php
				$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'passport_num',
				'mask' => '9999 999999'));
			?>
			<?php echo $form->error($model, 'passport_num'); ?>
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
				),
				'htmlOptions' => array(
					'value' => ($model->dt_of_issue && $model->dt_of_issue != '0000-00-00') ? SiteHelper::formatDate($model->dt_of_issue, 'Y-m-d', 'd.m.Y') : ''
				)
			)); ?>
			<?php echo $form->error($model, 'dt_of_issue'); ?>
		</div>
	</div>
	<!-- extended -->

	<?php echo $form->dropDownListControlGroup($model,'type', Clients::getTypes(), array('id' => 'type')); ?>
	
	<div class="info" style="<? if($model->type != 2){?>display: none;<?}?>">
	<?php
		$this->renderPartial('/clientsInfo/_rows', array(
			'model' => $model->info ? $model->info : $info,
			'form' => $form
		));
	?>
	<?php
		$this->renderPartial('/bankAccounts/_rows', array(
			'models' => $accounts,
			'form' => $form
		));
	?>
	</div>
	<script>
	jQuery(".show-extended").on("click", function(){
		jQuery("#ext").toggle();
	});

	jQuery("#type").on("change", function(){
		var type = jQuery(this).val();
		type == 2 ? jQuery(".info").show() : jQuery(".info").hide();
	});
	</script>
<?
$cs = Yii::app()->clientScript;
$cs->registerScript('clients','

',CClientScript::POS_READY);
?>