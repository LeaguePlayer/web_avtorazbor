<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'requests-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('step1/_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php //echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отменить заявку', array('url'=>$this->createUrl('cancel', array('id' => $model->id)), 'color' => TbHtml::BUTTON_COLOR_DANGER)); ?>
        <?php echo TbHtml::submitButton('Поставить на резерв', array('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'class' => 'pull-right'))?>
	</div>

<?php $this->endWidget(); ?>
