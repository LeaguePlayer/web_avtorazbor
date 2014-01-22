<fieldset>
 
    <legend>Реквизиты</legend>

	<?php echo $form->textFieldControlGroup($model,'inn',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'kpp',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'bank',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'num_account',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'name_company',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'address',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

</fieldset>