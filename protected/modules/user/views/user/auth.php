<div class="auth">
	<p class="caption">Авторизация</p>
	<?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'auth-form',
            'action' => $this->createUrl('/user/authenticate/auth'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'request_form')
        )) ?>
                <div class="flash">
                    <?php echo $form->error($model,'username',array('style'=>'color:red;font-size:10px;'));?>
                    <?php echo $form->error($model,'password',array('style'=>'color:red;font-size:10px;'));?>
                </div>
                <ul>
                        <li>
                            <?php echo $form->labelEx($model,'username');?>
                            <?php echo $form->textField($model,'username',array('class'=>'span8','maxlength'=>255)); ?>
                            
                        </li>
                        <li>
                            <?php echo $form->labelEx($model,'password');?>
                            <?php echo $form->passwordField($model,'password',array('class'=>'span8','maxlength'=>255)); ?>
                            
                        </li>
                        <li class="sub">
    	                    <? echo CHtml::submitButton('Отправить',array(
    	                            'class'=>'i-submit',
    	                            'type' => 'submit'
    	                        ));
    	                    ?>
                        </li>
                </ul>
                <?php $this->endWidget(); ?>
</div>