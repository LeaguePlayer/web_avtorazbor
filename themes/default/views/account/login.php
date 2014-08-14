<div id="login" >
            <!-- <dl>
                <dt>
                    Задать вопрос
                </dt>
                <dd>
                    <span class="req">*</span>
                    - поля, обязательные для заполнения
                </dd>
            </dl> -->
            <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'ownPrice-form',
            'action' => $this->createUrl('/account/login'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnType' => true,
                'validateOnSubmit' => true,
            ),
                'htmlOptions' => array('class' => 'request_form')
            )) ?>
                <ul>
                    <li>
                        <input type="hidden" name="return" value="<?=$_GET['return']?>">
                        <?php echo $form->labelEx($model,'email');?>
                        <?php echo $form->textField($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'password');?>
                        <?php echo $form->textField($model,'password',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'password',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?=CHtml::submitButton('Авторизироваться',array('class'=>'i-submit'))?>
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
