<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'recoveryPassword-form',
        'action' => $this->createUrl('/account/recoveryPassword/'.$model->hash),
        'enableClientValidation' => true,
        'clientOptions' => array(
            //'validateOnType' => true,
            'validateOnSubmit'=>true,
        ),
     'htmlOptions' => array('class' => 'changePwdHash')
    )) ?>
    <ul>
        <li>
            <?php echo $form->labelEx($model,'newPassword');?>
            <?php echo $form->textField($model,'newPassword',array('class'=>'i-text','maxlength'=>255)); ?>
            <?php echo $form->error($model,'newPassword',array('style'=>'color:red;font-size:10px;'));?>
        </li>
        <li>
            <?php echo $form->labelEx($model,'verifyPassword');?>
            <?php echo $form->textField($model,'verifyPassword',array('class'=>'i-text','maxlength'=>255)); ?>
            <?php echo $form->error($model,'verifyPassword',array('style'=>'color:red;font-size:10px;'));?>
        </li>
        <li class="sub">
        	<input type="submit" class="i-submit">
        </li>
    </ul>

<?php $this->endWidget(); ?>
</div>