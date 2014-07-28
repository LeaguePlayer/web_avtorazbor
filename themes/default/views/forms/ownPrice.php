<div id="own-price" name="qst" class="qst" style="display: none;">
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
            'id' => 'ownPrice-form',
            'action' => $this->createUrl('/ajaxRequests/saveOwnPrice'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnType' => true,
                'validateOnSubmit' => true,
                'afterValidate' => "js: function(form, data, hasError) {
                    if ( hasError ) return;

                    form = $('#ownPrice-form');
                    var action = form.attr('action');
                    $.ajax({
                        url: action,
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize(),
                        success: function(data) {

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
						<?php echo $form->labelEx($model,'own_price');?>
						<?php echo $form->textField($model,'own_price',array('class'=>'span8','maxlength'=>255)); ?>
						<?php echo $form->error($model,'own_price',array('style'=>'color:red;font-size:10px;'));?>
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
