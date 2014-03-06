<div class="acc">
	<h5>Счет - <?=$id?></h5>
	<?php echo TbHtml::errorSummary($model); ?>

	<?if($model->id):?>
		<?php echo TbHtml::activeHiddenField($model,'['.$id.']id'); ?>
	<?endif;?>

	<?php echo TbHtml::activeTextFieldControlGroup($model,'['.$id.']bank',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo TbHtml::activeTextFieldControlGroup($model,'['.$id.']num_account',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo TbHtml::activeTextFieldControlGroup($model,'['.$id.']bik',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo TbHtml::activeTextFieldControlGroup($model,'['.$id.']korr',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo TbHtml::activeTextFieldControlGroup($model,'['.$id.']city',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo TbHtml::activeHiddenField($model,'['.$id.']client_id'); ?>
</div>