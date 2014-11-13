<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'recoveryPassword-form',
        'action' => $this->createUrl('/account/recoveryPassword'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnType' => true,
            'validateOnSubmit'=>true,
        ),
     'htmlOptions' => array('class' => 'changePwdHash')
    )) ?>
    <p>
        <strong>Забыли пароль?</strong>
        <br>
        <br>
        Введите в «E-mail» адрес Вашей электронной почты<br> и Вам будет отправлено письмо с инстркцией дальнейших действий!
        <br>
        <br>
    </p>
    <ul>
        <li>
            <?php echo $form->labelEx($model,'email');?>
            <?php echo $form->textField($model,'email',array('class'=>'i-text','maxlength'=>255)); ?>
            <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
        </li>
        <li class="sub">
        	<input type="submit" class="i-submit">
        </li>
    </ul>

<?php $this->endWidget(); ?>
</div>