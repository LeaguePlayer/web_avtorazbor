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
			                            <?php echo $form->textField($model,'name',array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'name',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'phone');?>
			                            <?php echo $form->textField($model,'phone',array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'email');?>
			                            <?php echo $form->textField($model,'email',array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'brand');?>
			                            <?php echo $form->dropDownList($model,'brand',
			                            		CHtml::listData(CarBrands::model()->findAll(),'id','name'),
			                            		array('class'=>'i-text','maxlength'=>255)
			                            	); ?>
			                            <?php echo $form->error($model,'brand',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'modelName');?>
			                            <?php echo $form->textField($model,'modelName',array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'modelName',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'year');?>
			                            <?php echo $form->dropDownList($model,'year',UsedCars::getYears(),array('class'=>'i-text','maxlength'=>255)); ?>
			                            <?php echo $form->error($model,'mass',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>

			                        <li>
			                            <?php echo $form->labelEx($model,'capacity');?>
			                            <?php echo $form->textField($model,'capacity',array('class'=>'i-text'));?>
			                            <?php echo $form->error($model,'capacity',array('style'=>'color:red;font-size:10px;'));?>
			                        </li>
			                        <li>
			                            <?php echo $form->labelEx($model,'transmission');?>
			                            <?php echo $form->dropDownList($model,'transmission',UsedCarInfo::transmissionList(),array('class'=>'i-text'));?>
			                            <?php echo $form->error($model,'transmission',array('style'=>'color:red;font-size:10px;'));?>
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
				<br>
				<br>
				<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Если вы хотите быстро продать свой автомобиль, то немедленно звоните нам. Мы осуществляем:</p>

<ul style="outline: 0px; margin-top: 9px; margin-bottom: 20px; margin-left: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif; line-height: normal;">
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">выкуп битых авто после ДТП;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">и легковых автомобилей с пробегом в хорошем состоянии;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">выкуп грузовых автомобилей (иностранного пройзводства).</span></li>
</ul>

<h2 style="outline: 0px; font-size: 22px; font-family: Arial, Helvetica, sans-serif; font-weight: normal; line-height: normal; margin-top: 30px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(131, 111, 68);">Номер телефона для связи: +7 (343) 201-201-9 ; +7 (343) 201-201-1</h2>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Фото машин можно отправить на e-mail: info@razbor66.ru</p>

<p>&nbsp;</p>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;"><span style="outline: 0px; margin: 0px; padding: 0px; border: 0px; font-size: 18px; vertical-align: baseline; color: rgb(41, 41, 41);">Оценка автомобилей</span></p>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Вы можете выслать фотографии машины для оценки, либо вызвать оценщика в удобное для вас место и время. Исходя из состояния автомобиля оценщик предлагает вам цену за автомобиль.&nbsp;<span style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;">Мы всегда даем лучшие цены на машину, а не стараемся снизить ее стоимость. Нам нужны ваши автомобили, а не ваши деньги!</span></p>

<p>&nbsp;</p>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;"><span style="outline: 0px; margin: 0px; padding: 0px; border: 0px; font-size: 18px; vertical-align: baseline; color: rgb(41, 41, 41);">Документы, необходимые для выкупа авто</span></p>

<p style="outline: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif;">Процесс выкупа автомобиля пройдет еще быстрее, если вы подготовите документы:</p>

<ul style="outline: 0px; margin-top: 9px; margin-bottom: 20px; margin-left: 0px; border: 0px; vertical-align: baseline; color: rgb(9, 9, 9); font-family: Arial, Helvetica, sans-serif; line-height: normal;">
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">ПТС;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">Свидетельство о регистрации ТС;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">Ваш паспорт;</span></li>
	<li style="outline: 0px; margin: 0px; padding: 0px 0px 10px 28px; border: 0px; vertical-align: baseline; list-style: none; background: url(http://razbor66.ru/Content/images/line.png) 0px 10px no-repeat;"><span class="black" style="outline: 0px; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 0, 0) !important;">Генеральная доверенность (если Вы не собственник)</span></li>
</ul>

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

</div>