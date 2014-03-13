<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'used-cars-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

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

		Yii::app()->clientScript->registerScript('modalUsed1', "jQuery('#usedCarModal').modal();", CClientScript::POS_READY);
		Yii::app()->clientScript->registerScript('modalUsed2', "jQuery('.to-list').on('click', function(){ window.location.href = '/admin/usedCars/'; });", CClientScript::POS_READY);
	?>
	<?php endif; ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model, 'dop' => $dop, 'owner' => $owner), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/usedcars/list')); ?>
	</div>

<?php $this->endWidget(); ?>
