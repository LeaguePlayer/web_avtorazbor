<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'requests-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('step2/_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php //echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отменить заявку', array('url'=>$this->createUrl('cancel', array('id' => $model->id)), 'color' => TbHtml::BUTTON_COLOR_DANGER)); ?>
        <?php echo TbHtml::linkButton('Свернуть заявку', array('url'=>$this->createUrl('list'))); ?>
        <?php echo TbHtml::button('Печать', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'onclick'=>'window.print();')); ?>
        <?php echo TbHtml::submitButton('Выписать счета', array('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'class' => 'pull-right'))?>
	</div>

<?php $this->endWidget(); ?>
