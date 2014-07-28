	<?php echo $form->textFieldControlGroup($model,'attr_id',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'value',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', CategoryAttrValues::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
