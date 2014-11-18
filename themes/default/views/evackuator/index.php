<div class="page">

    <h1 class="head">
       Услуги автоэвакуатора
    </h1>

    <div class="wr">
        <div class="coll left">
            <div class="content clear">
			<div class="form">
		            <?php $form = $this->beginWidget('CActiveForm', array(
		            'id' => 'evacuator-form',
		            'action' => $this->createUrl('/Evackuator'),
		            'enableClientValidation' => true,
		            'clientOptions' => array(
		                'validateOnType' => true,
		                'validateOnSubmit' => true,
		            ),
		            'htmlOptions' => array('class' => 'erequest_form')
		        )) ?>
		        <dl>
		        	<dd>
		                <ul>
		                        <li>
		                            <?php echo $form->labelEx($model,'name');?>
		                            <?php echo $form->textField($model,'name',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'Ваше имя...')); ?>
		                            <?php echo $form->error($model,'name',array('style'=>'color:red;font-size:10px;'));?>
		                        </li>

		                        <li>
		                            <?php echo $form->labelEx($model,'phone');?>
		                            <?php echo $form->textField($model,'phone',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'+7 ___ ___ __ __')); ?>
		                            <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
		                        </li>

		                        <li>
		                            <?php echo $form->labelEx($model,'mail');?>
		                            <?php echo $form->textField($model,'mail',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'somemail@gmail.com')); ?>
		                            <?php echo $form->error($model,'mail',array('style'=>'color:red;font-size:10px;'));?>
		                        </li>

			                    <li>
			                        <?php echo $form->labelEx($model,'brand');?>
			                        <?php echo $form->dropDownList($model,'brand',
		                            		CHtml::listData(CarBrands::model()->findAll(),'id','name'),
		                            		array(
		                            			'empty'=>'Выберите марку авто',
		                            			'class'=>'i-text',
		                            			'maxlength'=>255,
		                            			'ajax' => array(
												'type'=>'POST', //request type
												'url'=>CController::createUrl('evackuator/getModels'), //url to call.
												//Style: CController::createUrl('currentController/methodToCall')
												'update'=>'#Evackuator_car_model_id', //selector to update
												)
		                            		)
		                            ); ?>
			                            <?php echo $form->error($model,'brand',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>
			                        <li>
			                            <?php echo $form->labelEx($model,'car_model_id');?>
			                            <?php echo $form->dropDownList($model,'car_model_id',array(), array('empty'=>'Выберите марку авто', 'class'=>'i-text','maxlength'=>255,'placeholder'=>'Модель авто')); ?>
			                            <?php echo $form->error($model,'car_model_id',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

		                        <li>
		                            <?php echo $form->labelEx($model,'mass');?>
		                            <?php echo $form->textField($model,'mass',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'Вес автомобиля...')); ?>
		                            <?php echo $form->error($model,'mass',array('style'=>'color:red;font-size:10px;'));?>
		                        </li>

		                        <li>
		                            <?php echo $form->labelEx($model,'distance');?>
		                            <?php echo $form->textField($model,'distance',array('class'=>'i-text','placeholder'=>'Расстояние от города...')); ?>
		                            <?php echo $form->error($model,'distance',array('style'=>'color:red;font-size:10px;'));?>
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
		</div>
		<br>
		<div class="desc">
			<?=$content?>
		</div>
	</div>
	</div>
</div>
