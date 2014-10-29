	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'vacansy_id',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', VacansyCallBack::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
