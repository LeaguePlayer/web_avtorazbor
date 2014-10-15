
<div id="popup" class="qst">
        <div class="bx">

            <dl>
                <dt class="head">
                    Задать вопрос
                </dt>
                <dd>
                    <span class="req">*</span>
                    - поля, обязательные для заполнения
                </dd>
            </dl>
            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm',array(
                    'id'=>'question-form',
                    'action'=>'/ajaxRequests/saveQuestion',
                    'enableAjaxValidation'=>true,
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        'afterValidate'=>'function(hasError){
                            if (hasError)
                                return;
                            $.fancybox.close();
                        }'
                    ),
                    'focus'=>array($model,'name'),
                )); ?>
                <ul>
                    <li>
                        <?php echo $form->labelEx($model,'name');?>
                        <?php echo $form->textField($model,'name',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'name',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'phone');?>
                        <?php echo $form->textField($model,'phone',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'mail');?>
                        <?php echo $form->textField($model,'mail',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'mail',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'question');?>
                        <?php echo $form->textarea($model,'question',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'question',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'theme');?>
                        <?php echo $form->dropDownList($model,'theme',array(1=>'Автозапчасти'),array('class'=>'i-text'));?>
                        <?php echo $form->error($model,'theme',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li class="sub">
                        <input type="submit" class="i-submit" value="Отправить">
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
