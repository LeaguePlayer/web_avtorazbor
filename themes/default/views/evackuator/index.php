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
			<p>Хотите заказать эвакуатор по Тюмени и Тюменской области? &nbsp;Мы поможем вам быстро и</p>
			<p>недорого.</p>
			<p>&nbsp; &nbsp;&bull; Эвакуатор круглосуточно и без выходных.</p>
			<p>&nbsp; &nbsp;&bull; Оперативная подача эвакуатора.</p>
			<p>&nbsp; &nbsp;&bull; Эвакуация авто по Тюмени и близлежащим областям.</p>
			<p>Номер телефона для вызова эвакуатора: +7 (9088) 73-55-73; +7 (9044) 96-44-00</p>
			<p>Служба автоэвакуации &laquo;Авторазбор72&raquo; предлагает следующие услуги:</p>
			<p>&nbsp; &nbsp;&bull; эвакуация легковых автомобилей с поломками, &nbsp;аварийных после ДТП</p>
			<p>&nbsp; &nbsp;&bull; перевозка автомобилей в любом состоянии без сопровождения собственником</p>
			<p>&nbsp; &nbsp;&bull; перевозка спортивных автомобилей до мест проведения соревнований</p>
			<p>&nbsp; &nbsp;&bull; эвакуация и транспортировка мототехники и снегоходов квадроциклов</p>
			<p>Услуги автоэвакуатора в Тюмени</p>
			<p>&nbsp; &nbsp;&bull;&nbsp;Время заказа: круглосуточно</p>
			<p>&nbsp; &nbsp;&bull; Цена услуги: договорная, минимальный заказ от 1 000 &nbsp;рублей. Стоимость&nbsp;</p>
			<p>уточняйте по телефону: &nbsp;+7 (9088) 73-55-73; +7 (9044) 96-44-00</p>
			<p>&nbsp; &nbsp;&bull; Автопарк Эвакуаторов: Isuzu до 4,5 тонн &laquo;сдвижная платформа&raquo;, Isuzu до 4,5 тонн&nbsp;</p>
			<p>&laquo;сдвижная платформа&raquo;, ГАЗ Газель 3302 до 2-х тонн &laquo;ломаная платформа&raquo; все наши&nbsp;</p>
			<p>эвакуаторы оборудованы профессиональной электрической сдвижной или гидравлической&nbsp;</p>
			<p>лебедкой.</p>
		</div>
	</div>
	</div>
</div>
