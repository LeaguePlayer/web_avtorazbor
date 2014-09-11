    <?php $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'ownPrice-form',
	            'action' => $this->createUrl('/cart'),
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
	            </ul>
	        </dd>
	    </dl>
	    <span></span>
	    <dl>
	    	<dt>
	    		Доставка
	    	</dt>
	    	<dd>
	    		<ul>
	                <li>
	                	<?php echo $form->labelEx($model,'delivery');?>
	                	<div class="delivery">
	                    	<?php echo $form->dropDownList($model,'delivery', Requests::getDeliveryType(),array('empty'=>'Выберите способ получения', 'class'=>'select '));?>
	                    	<?php echo $form->error($model,'delivery',array('style'=>'color:red;font-size:10px;'));?>
	                    </div>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'city');?>
	                    <?php echo $form->textField($model,'city',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'city',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'adress');?>
	                    <?php echo $form->textField($model,'adress',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'adress',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	            </ul>
	    	</dd>

	    </dl>
	    <span></span>
	    <dl class="reqvizit">
	        <dt>Реквизиты</dt>
	        <dd>
	        	<ul>
	                <li>
	                	<?php echo $form->labelEx($model,'company_name');?>
	                	<div class="delivery">
	                    	<?php echo $form->textField($model,'company_name', array('class'=>'i-text'));?>
	                    	<?php echo $form->error($model,'company_name',array('style'=>'color:red;font-size:10px;'));?>
	                    </div>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'inn');?>
	                    <?php echo $form->textField($model,'inn',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'inn',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'okpo');?>
	                    <?php echo $form->textField($model,'okpo',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'okpo',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'kpp');?>
	                    <?php echo $form->textField($model,'kpp',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'kpp',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'ur_adress');?>
	                    <?php echo $form->textField($model,'ur_adress',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'ur_adress',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	                <li>
	                    <?php echo $form->labelEx($model,'piz_adress');?>
	                    <?php echo $form->textField($model,'piz_adress',array('class'=>'i-text')); ?>
	                    <?php echo $form->error($model,'piz_adress',array('style'=>'color:red;font-size:10px;'));?>
	                </li>
	            </ul>
	        </dd>
	    </dl>
	    <div>
	    <? echo CHtml::submitButton('Оформить',array(
                'class'=>'i-submit',
                'type' => 'submit'
            ));
        ?>
        </div>
	    <?php $this->endWidget(); ?>