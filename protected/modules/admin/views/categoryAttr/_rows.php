	<?php echo $form->textFieldControlGroup($model,'category_id',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'attr',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'type',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', CategoryAttr::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
