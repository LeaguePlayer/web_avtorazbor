<div id="book" name="qst" class="qst" style="display: none;">
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
            <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'BookPart-form',
            'action' => $this->createUrl('/ajaxRequests/saveBookPart'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnType' => true,
                'validateOnSubmit' => true,
                'afterValidate' => "js: function(form, data, hasError) {
                    
                    if ( hasError ) return;
                    form = $('#BookPart-form');
                    var action = form.attr('action');
                    $.ajax({
                        url: action,
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize(),
                        success: function(data) {
                            console.log(data)
                            if ( data.success ) {
                                window.location.href = '".$this->createUrl('/ajaxRequests/thanks')."';
                                console.log(data);
                            }
                        },
                        error:function(){
                            console.log(111111)
                        }
                    });
                }"
            ),
            'htmlOptions' => array('class' => 'request_form')
        )) ?>
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
                        <?php echo $form->labelEx($model,'car_info');?>
                        <?php echo $form->textField($model,'car_info',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'car_info',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'year');?>
                        <?php echo $form->textArea($model,'year',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'year',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'capacity');?>
                        <?php echo $form->textField($model,'capacity',array('class'=>'span8')); ?></li>
                        <?php echo $form->error($model,'capacity',array('style'=>'color:red;font-size:10px;'));?>

                    <li>
                        <?php echo $form->labelEx($model,'fuel');?>
                        <?php echo $form->textField($model,'fuel',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'fuel',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'vin');?>
                        <?php echo $form->textField($model,'vin',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'vin',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li>
                        <?php echo $form->labelEx($model,'parts');?>
                        <?php echo $form->textArea($model,'parts',array('class'=>'span8','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'parts',array('style'=>'color:red;font-size:10px;'));?>
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
        </div>
    </div>
