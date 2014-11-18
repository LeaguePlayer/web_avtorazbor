<div class="page">

    <h1 class="head">
       Выкуп авто
    </h1>

    <div class="wr">
        <div class="coll left">
            <div class="content clear">
				<div class="form">
			            <?php $form = $this->beginWidget('CActiveForm', array(
			            'id' => 'buyout-form',
			            'action' => $this->createUrl('/buyout'),
			            'enableClientValidation' => true,
			            'clientOptions' => array(
			                'validateOnType' => false,
			                'validateOnSubmit' => true,
			            ),
			            'htmlOptions' => array('class' => 'erequest_form')
			        )) ?>
			        <dl>
			        	<dd>
			                <ul>
			                        <li>
			                            <?php echo $form->labelEx($model,'name');?>
			                            <?php echo $form->textField($model,'name',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'Ваше Имя')); ?>
			                            <?php echo $form->error($model,'name',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'phone');?>
			                            <?php echo $form->textField($model,'phone',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'+7 ___ ___ __ __')); ?>
			                            <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'email');?>
			                            <?php echo $form->textField($model,'email',array('class'=>'i-text','maxlength'=>255,'placeholder'=>'somemail@gmail.com')); ?>
			                            <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
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
													'url'=>CController::createUrl('buyout/getModels'), //url to call.
													//Style: CController::createUrl('currentController/methodToCall')
													'update'=>'#Buyout_car_model_id', //selector to update
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
			                            <?php echo $form->labelEx($model,'year');?>
			                            <?php echo $form->dropDownList($model,'year',UsedCars::getYears(),array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'mass',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'capacity');?>
			                            <?php echo $form->textField($model,'capacity',array('class'=>'i-text','placeholder'=>'1.2 л...'));?>
			                            <?php echo $form->error($model,'capacity',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>
			                        <li>
			                            <?php echo $form->labelEx($model,'transmission');?>
			                            <?php echo $form->dropDownList($model,'transmission',UsedCarInfo::transmissionList(),array('class'=>'i-text'));?>
			                            <?php echo $form->error($model,'transmission',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>
			                        <li>
			                            <label for="Boyout_comment">Дополнительная<br>информация</label>
			                            <?php echo $form->textarea($model,'comment',array('class'=>'i-text','placeholder'=>'Текст сообщения...'));?>
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
			</div>
			<div class="desc">
				<?=$content?>
			</div>
		</div>
		<div class="coll right">
			<div class="modul one">

                    <p class="phone"><?=Settings::getValue('evacuator_phone')?></p>
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

</div>