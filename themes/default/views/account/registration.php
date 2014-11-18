<div class="page">

    <h1 class="head">
       Регистрация
    </h1>

    <div class="wr">
        <div class="coll left">
            <div class="content clear">
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'registration-form',
					'action'=>'/account/registration',
					'enableClientValidation' => true,
		            'clientOptions' => array(
		                'validateOnType' => false,
		                'validateOnSubmit' => true,
		            ),
					'htmlOptions' => array('enctype'=>'multipart/form-data'),
				)); ?>
				<dl>
					<dd>
				<ul>
					<li>
						<?php echo $form->labelEx($model,'fio'); ?>
						<?php echo $form->textField($model,'fio',array('class'=>'i-text')); ?>
						<?php echo $form->error($model,'fio'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->textField($model,'email',array('class'=>'i-text')); ?>
						<?php echo $form->error($model,'email'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'phone'); ?>
						<?php echo $form->textField($model,'phone',array('class'=>'i-text','placeholder'=>'+7 ___ ___ __ __')); ?>
						<?php echo $form->error($model,'phone'); ?>
					</li>
					
					<li>
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->passwordField($model,'password',array('class'=>'i-text')); ?>
						<?php echo $form->error($model,'password'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'verifyPassword'); ?>
						<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'i-text')); ?>
						<?php echo $form->error($model,'verifyPassword'); ?>
					</li>
					<li>	
						<label>
							Подписаться<br> на e-mail<br> рассылку
						</label>
						<div class="group">
                            <!-- <input hidden="" type="checkbox" id="check1"> -->
                            <?=$form->checkBox($model,'subscribe_news',array('hidden'=>true))?>
                            <label for="RegistrationForm_subscribe_news">
                                <span></span>
                                На новости
                            </label>

                            <?=$form->checkBox($model,'subscribe_new',array('hidden'=>true))?>
                            <label for="RegistrationForm_subscribe_new"><span>
                                  
                                </span>
                                  На новинки
                            </label>
                            <!-- <input hidden="" type="checkbox" name="check" id="check3">
                            <label for="check3">
                            <span></span>
                                На новинки
                            </label> -->
                        </div>  
	                    <p class="reg-desc">
	                        Подписаться на sms рассылку вы можете в вашем личном кабинете<br> после регистрации.
	                    </p>
					</li>
					<li>
						<?php echo CHtml::submitButton('Зарегистрироваться',array('class'=>'i-submit')); ?>
					</li>
				</ul>
				</dd>	
				<dl>
				<?php $this->endWidget(); ?>
				</div><!-- form -->
                
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

        <div class="clear"></div>
    </div>
</div>