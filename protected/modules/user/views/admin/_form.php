<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>
	
	<?php echo $form->textFieldControlGroup($model,'username',array('size'=>20,'maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'password',array('size'=>60,'maxlength'=>128)); ?>

	<?php echo $form->textFieldControlGroup($model,'email',array('size'=>60,'maxlength'=>128)); ?>

	<?php echo $form->dropDownListControlGroup($model,'superuser',User::itemAlias('AdminStatus')); ?>

	<?php echo $form->dropDownListControlGroup($model,'status',User::itemAlias('UserStatus')); ?>
<?php 
		$profileFields=Profile::getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
		<?php //echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownListControlGroup($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo TbHtml::activeTextAreaControlGroup($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textFieldControlGroup($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php //echo $form->error($profile,$field->varname); ?>
			<?php
			}
		}
?>
	<div class="form-actions">
		<?php echo TbHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>