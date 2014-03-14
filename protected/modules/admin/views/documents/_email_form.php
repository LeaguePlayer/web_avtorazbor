<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Письмо успешно отправлено.', array('id' => 'success', 'style' => 'display: none;', 'closeText' => false)); ?>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_DANGER, 'Не заполнено поле E-mail.', array('id' => 'error', 'style' => 'display: none;', 'closeText' => false)); ?>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_DANGER, 'Неправильно заполнен E-mail.', array('id' => 'error2', 'style' => 'display: none;', 'closeText' => false)); ?>

<?php echo CHtml::beginForm(Yii::app()->createUrl('admin/documents/sendFile'), 'POST', array('id' => 'modal-email-form')); ?>
	<?php echo TbHtml::label('E-mail', 'Email[email]');?>
	<?php echo TbHtml::textFieldControlGroup('Email[email]', '', array('class' => 'user-email'));?>
	<?php echo TbHtml::hiddenField('Email[document_id]', 0, array('class' => 'document-id'));?>
<?php echo CHtml::endForm(); ?>