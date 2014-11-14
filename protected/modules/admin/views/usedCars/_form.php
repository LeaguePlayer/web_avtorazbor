<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'used-cars-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model, 'dop' => $dop, 'owner' => $owner), true), 'active' => true); ?>
	<?php $tabs[] = array('label' => 'Галерея', 'content' => $this->renderPartial('_gallery', array('form'=>$form, 'model' => $model, 'dop' => $dop, 'owner' => $owner), true), 'active' => false); ?>
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/usedcars/list')); ?>
	</div>

<?php $this->endWidget(); ?>

<?php if(Yii::app()->user->hasFlash('success')):?>
<?php
	$this->widget('bootstrap.widgets.TbModal', array(
		'id' => 'usedCarModal',
		'header' => Yii::app()->user->getFlash('success'),
		'content' => $this->renderPartial('_modal', array('model' => $model), true),
		'footer' => array(
			TbHtml::button('Закрыть', array('data-dismiss' => 'modal')),
			TbHtml::button('Перейти в список', array('data-dismiss' => 'modal', 'class' => 'to-list')),
		),
	));
?>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
	'id' => 'sendEmail',
	'header' => 'Форма отправки на e-mail',
	'content' => $this->renderPartial('/documents/_email_form', array(), true),
	'footer' => array(
		TbHtml::button('Отправить на почту', array(
			'loading' => 'Отправка...', 
			'data-complete-text' => 'Отправить на почту',
			'color' => TbHtml::BUTTON_COLOR_PRIMARY, 
			// 'data-id' => $model->document->id, 
			'class' => 'send-file')
		),
		TbHtml::button('Закрыть', array('class' => 'close-email-modal')),
	),
));

Yii::app()->clientScript->registerScript('modalUsed1', "jQuery('#usedCarModal').modal();", CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('modalUsed2', "jQuery('.to-list').on('click', function(){ window.location.href = '/admin/usedCars/'; });", CClientScript::POS_READY);
?>