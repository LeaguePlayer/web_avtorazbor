    <?php $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'ownPrice-form',
	            'action' => $this->createUrl('/cart/issueBook'),
	            'method'=>'get',
	            'enableClientValidation' => true,
	            'clientOptions' => array(
	                'validateOnType' => true,
	            ),
	            'htmlOptions' => array('class' => 'request_form')
	        )) ?>
	        <dl>
	            <dt>Личные данные</dt>
	        <dd>
	        	<input type="hidden" value="1" id="client-type" name="Clients[type]">
	            <ul>
	                <li>
	                    <?php echo $form->labelEx($model,'fio');?>
	                    <?php echo $form->textField($model,'fio',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'phone');?>
	                    <?php echo $form->textField($model,'phone',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'email');?>
	                    <?php echo $form->textField($model,'email',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
	                </li>

	                <li>
	                    <?php echo $form->labelEx($model,'subscribe_mail');?>
	                    <?php echo $form->checkbox($model,'subscribe_mail',array('class'=>'span2')); ?>
	                    <?php echo $form->error($model,'subscribe_mail',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'subscribe_sms');?>
	                    <?php echo $form->checkbox($model,'subscribe_sms',array('class'=>'span2')); ?>
	                    <?php echo $form->error($model,'subscribe_sms',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	            </ul>
	        </dd>
	    </dl>
	    <dl class="reqvizit hide">
	        <dt>Реквизиты</dt>
	        <dd>
	        	<ul>
	        		<li>
                        <?php echo $form->labelEx($info,'name_company');?>
                        <?php echo $form->textField($info,'name_company',array('class'=>'i-text')); ?>
                        <?php echo $form->error($info,'name_company',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($info,'inn');?>
                        <?php echo $form->textField($info,'inn',array('class'=>'i-text')); ?>
                        <?php echo $form->error($info,'inn',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($info,'kpp');?>
                        <?php echo $form->textField($info,'kpp',array('class'=>'i-text')); ?>
                        <?php echo $form->error($info,'kpp',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($info,'ur_address');?>
                        <?php echo $form->textarea($info,'ur_address',array('class'=>'i-text')); ?>
                        <?php echo $form->error($info,'ur_address',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($info,'address');?>
                        <?php echo $form->textarea($info,'address',array('class'=>'i-text')); ?>
                        <?php echo $form->error($info,'address',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
	        	</ul>
	        </dd>
	    </dl>
	    <? echo CHtml::submitButton('Оформить',array(
                            'class'=>'i-submit',
                            'type' => 'submit'
                        ));
                    ?>
	    <?php $this->endWidget(); ?>