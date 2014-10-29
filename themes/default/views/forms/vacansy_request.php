
<div id="vacansyCallBack" class="qst">
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
                    'action'=>'/ajaxRequests/saveVacansy',
                    'enableAjaxValidation'=>true,
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        'afterValidate'=>'js:function(form,data,hasError){
                            return false;
                        }'
                    ),
                    'focus'=>array($model,'name'),
                )); ?>
                <ul>
                    <li>
                        <?php echo $form->labelEx($model,'fio');?>
                        <?php echo $form->textField($model,'fio',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'phone');?>
                        <?php echo $form->textField($model,'phone',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'email');?>
                        <?php echo $form->textField($model,'email',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'vacansy_id');?>
                        <?php echo $form->dropDownList($model,'vacansy_id',CHtml::listData(Vacansy::model()->findAll('status=1'),'id','post'),array('empty'=>'Выберите вакансию', 'class'=>'i-text','maxlength'=>255,'style'=>'width:262px;')); ?>
                        <?php echo $form->error($model,'vacansy_id',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li class="sub">
                        <input type="submit" class="i-submit" value="Отправить">
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
