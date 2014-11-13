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
			<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Если вы хотите заказать эвакуатор по Екатеринбургу, Березовскому или для транспортировки авто&nbsp; по Свердловской области. Мы поможем вам быстро и дешево.</p>

<h2 style="outline: 0px; font-size: 22px; font-family: Arial, Helvetica, sans-serif; font-weight: normal; line-height: normal; margin-top: 30px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(131, 111, 68);">Услуги грузового автоэвакуатора</h2>

<ul style="outline: 0px; margin-top: 9px; margin-bottom: 20px; margin-left: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif; line-height: normal;">
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><strong style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;">Время заказа</strong>: с 9 до 20 часов.</li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><strong style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;">Цена услуги</strong>: договорная, минимальный заказ от 1 300 рублей. Стоимость уточняйте по телефону.</li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><strong style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;">Грузоподъемность</strong>&nbsp;эвакуатора&nbsp;<span style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; background-color: rgb(201, 215, 241);">Hyundai</span>&nbsp;HD-78 -&nbsp; 3,5 тонны</li>
</ul>

<h2 style="outline: 0px; font-size: 22px; font-family: Arial, Helvetica, sans-serif; font-weight: normal; line-height: normal; margin-top: 30px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(131, 111, 68);">Номер телефона для вызова эвакуатора: +7 (343) 201-36-06</h2>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Служба автоэвакуации &laquo;Разбор66&raquo; предлагает следующие услуги:</p>

<ul style="outline: 0px; margin-top: 9px; margin-bottom: 20px; margin-left: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif; line-height: normal;">
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">эвакуацию легковых автомобилей с поломками (в том&nbsp; числе аварийных);</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">перевозку автомобилей в любом состоянии без сопровождения собственником;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">перевозку спортивных автомобилей с малым дорожным просветом;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">эвакуацию и транспортировку квадроциклов, мототехники и снегоходов;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">услугу &laquo;трезвый водитель&raquo;.</span></li>
</ul>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Звоните, и мы поможем вам в любой ситуации!</p>

		</div>
	</div>
	</div>
</div>
