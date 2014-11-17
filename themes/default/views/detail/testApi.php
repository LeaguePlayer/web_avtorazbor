<?php $form=$this->beginWidget('CActiveForm',array(
	'id'=>'parts-form',
	'method'=>'POST',
	'action'=>'/api/savePart/id/'.$model->id,
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->textField($model,'name',array('class'=>'span8 name','maxlength'=>255)); ?>
	<br>
	<?php echo $form->textField($model,'alias',array('class'=>'span8 alias','maxlength'=>255)); ?>
<br>
	<?php echo $form->textField($model,'price_sell',array('class'=>'span8','maxlength'=>6)); ?>
<br>
	<?php echo $form->textField($model,'price_buy',array('class'=>'span8','maxlength'=>6)); ?>
<br>
	<?php echo $form->textarea($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	
	
<style type="text/css">
	ul{
		list-style: none;
		margin: 0;
	}

</style>




	<div class="form-actions">
		<?php echo CHtml::submitButton('Сохранить'); ?>
        <?php echo CHtml::linkButton('Отмена', array('url'=>'/admin/parts/list')); ?>
	</div>

<?php $this->endWidget(); ?>
