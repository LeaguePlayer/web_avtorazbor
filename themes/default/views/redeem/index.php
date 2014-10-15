<div class="page">
	<h1 class="head">Выкуп авто</h1>
		<div class="wr">
			<div class="coll left">
				<div class="content clear">
	            <div class="form">
	            <?php $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'BookPart-form',
	            'action' => $this->createUrl('/redeem'),
	            'enableClientValidation' => true,
	            'method'=>'POST',
	            'clientOptions' => array(
	                'validateOnType' => false,
	                'validateOnSubmit' => true,
	            ),
	            'htmlOptions' => array('class' => 'request_form')
	        )) ?>
	        <dl>
	        	<dt>
	        	</dt>
	        	<dd>
                <ul>
                    <li>
                        <?php echo $form->labelEx($model,'fio');?>
                        <?php echo $form->textField($model,'fio',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'phone');?>
                        <?php echo $form->textField($model,'phone',array('class'=>'i-text','placeholder'=>'+7 ___ ___ __ __')); ?>
                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'email');?>
                        <?php echo $form->textField($model,'email',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'brand');?>
                        <?php echo $form->dropDownList($model,'brand',CHtml::listData(CarBrands::model()->findAll(),'id','name'), array('class'=>'select')); ?>
                        <?php echo $form->error($model,'brand',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'model_name');?>
                        <?php echo $form->textField($model,'model_name',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'model_name',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'year');?>
                        <?php echo $form->textField($model,'year',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'year',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    

                    <li>
                        <?php echo $form->labelEx($model,'capacity');?>
                        <?php echo $form->textField($model,'capacity',array('class'=>'i-text')); ?>
                        <?php echo $form->error($model,'capacity',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'transmission');?>
                        <?php echo $form->textField($model,'transmission',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'transmission',array('style'=>'color:red;font-size:10px;'));?>
                    </li>
                    <li>
                        <?php echo $form->labelEx($model,'comment');?>
                        <?php echo $form->textArea($model,'comment',array('class'=>'i-text','maxlength'=>255)); ?>
                        <?php echo $form->error($model,'comment',array('style'=>'color:red;font-size:10px;'));?>
                    </li>

                    <li class="sub">
                    <? echo CHtml::submitButton('Отправить',array(
                            'class'=>'i-submit',
                            'type' => 'submit'
                        ));
                    ?>
                    </li>
                </ul>
            	</dd>
            </dl>
                <?php $this->endWidget(); ?>
            </div>
            <div class="desc">

            </div>
        	</div>
        </div>
        <div class="coll right">
	        <div class="modul one">

	                <p class="phone">+7 (343) 201-36-06</p>
	                <a href="/evackuator">
	                    Услуги автоэвакуатора
	                </a>
	        </div>
	        <div class="modul second">
	                
	                <p class="question">Есть вопросы?<br>
	                    <span>Напиши нам</span>
	                </p>
	                <a href="#popup" class="modal">
	                    Задать вопрос
	                </a>
	        </div>
	    </div>
    </div>
</div>