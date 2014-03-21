<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'clients-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="span12">
		<?php echo CHtml::activeLabelEx($model, 'fio')?>
		<?php echo $form->textField($model,'fio',array('maxlength'=>255)); ?>
	</div>
</div>
<div class="row">
	<div class="span12">
		<?php echo CHtml::activeLabelEx($model, 'phone')?>
		<?php
			$this->widget('CMaskedTextField', array(
				'model' => $model,
				'attribute' => 'phone',
				'mask' => '+7 (999) 999-99-99',
				'htmlOptions' => array()
			));
			?>
	</div>
</div>
<div class="row">
	<div class="span12">
		<?php echo CHtml::activeLabelEx($model, 'email')?>
		<?php echo $form->textField($model,'email',array('maxlength'=>255)); ?>
	</div>
</div>
<div class="row">
	<div class="span12"></div>
</div>
<div class="row">
	<div class="span12"></div>
</div>
<div class="row">
	<div class="span12"></div>
</div>
<div class="row">
	<div class="span12"></div>
</div>

<?php $this->endWidget(); ?>