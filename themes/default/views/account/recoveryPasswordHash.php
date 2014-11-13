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
    <p>
        <strong>Новый пароль</strong>
        <br>
        <br>
            Введиде Ваш новый паролья в поля Новый пароль и Повторите ввод нового пароля и нажмите кнопку сохранить.
        <br>
        <br>
    </p>
    <ul>
        <li>
            <?php echo $form->labelEx($model,'newPassword');?>
            <?php echo $form->passwordField($model,'newPassword',array('class'=>'i-text','maxlength'=>255)); ?>
            <?php echo $form->error($model,'newPassword',array('style'=>'color:red;font-size:10px;'));?>
        </li>
        <li>
            <?php echo $form->labelEx($model,'verifyPassword');?>
            <?php echo $form->passwordField($model,'verifyPassword',array('class'=>'i-text','maxlength'=>255)); ?>
            <?php echo $form->error($model,'verifyPassword',array('style'=>'color:red;font-size:10px;'));?>
        </li>
        <li class="sub">
        	<input type="submit" class="i-submit" value="Сохранить">
        </li>
    </ul>

<?php $this->endWidget(); ?>
</div>