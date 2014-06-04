<fieldset>
 
    <legend>Реквизиты</legend>
    <?php echo $form->textFieldControlGroup($model,'fio_rod',array('class'=>'span8','maxlength'=>255, 'placeholder' => 'Иванова Ивана Ивановича')); ?>

	<?php echo $form->textFieldControlGroup($model,'inn',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'kpp',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'name_company',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'address',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'ur_address',array('class'=>'span8','maxlength'=>255)); ?>

	<?php //echo $form->textFieldControlGroup($model,'client_id',array('class'=>'span8')); ?>

</fieldset>