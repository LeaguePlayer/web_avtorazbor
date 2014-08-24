
<div id="popup" style="display: none;">
        <div class="bx">

            <dl>
                <dt>
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
                    'focus'=>array($model,'name'),
                )); ?>
                <ul>
                    <li>
                        <?php echo $form->labelEx($model,'name');?>
                        <?php echo $form->textField($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'name',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'phone');?>
                        <?php echo $form->textField($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'mail');?>
                        <?php echo $form->textField($model,'mail',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'mail',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'question');?>
                        <?php echo $form->textField($model,'question',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'question',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'theme');?>
                        <?php echo $form->textArea($model,'theme',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
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
