<div id="own-price" name="qst" class="qst" style="display: none;">
        <div class="bx">
        <?
        if ($user_id)
        {
            $user=Yii::app()->db->createCommand()
                ->select('id,fio,phone,email')
                ->from("tbl_clients")
                ->where("id=$user_id")
                ->queryRow();
            $model->name=$user['fio'];
            $model->phone=$user['phone'];
            $model->mail=$user['email'];
        }
        ?>

            <dl>
                <dt>
                    Предложить свою цену
                </dt>
                <dd>
                    <span class="req">*</span>
                    - поля, обязательные для заполнения
                </dd>
            </dl>
            <div class="alert">
                <div class="warning" width="auto">
                    Пожалуйста, убедитесь что все поля введены корректно.
                </div>
            </div>
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
                        <?php echo $form->hiddenField($model,'car_id',array('id'=>'car_id')); ?>
                    </li>
                    <li>
                        <?php echo $form->hiddenField($model,'status',array('value'=>'0')); ?>
                    </li>
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
						<?php echo $form->labelEx($model,'own_price');?>
						<?php echo $form->textField($model,'own_price',array('class'=>'i-text','maxlength'=>255)); ?>
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
