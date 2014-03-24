<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'clients-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => (isset($valid) && $valid) ? array('data-valid' => $valid, 'data-id' => $model->id, 'data-text' => $info->name_company) : array()
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model, 'info' => $info, 'accounts' => $accounts), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>
	
	<?if(!Yii::app()->request->isAjaxRequest):?>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/clients/list')); ?>
	</div>
	<?endif;?>

<?php $this->endWidget(); ?>
