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
		                'validateOnType' => true,
		                'validateOnSubmit' => true,
		            ),
					'htmlOptions' => array('enctype'=>'multipart/form-data'),
				)); ?>
				<dl>
					<dd>
				<ul>
					<li>
						<?php echo $form->labelEx($model,'fio'); ?>
						<?php echo $form->textField($model,'fio'); ?>
						<?php echo $form->error($model,'fio'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->textField($model,'email'); ?>
						<?php echo $form->error($model,'email'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'phone'); ?>
						<?php echo $form->textField($model,'phone'); ?>
						<?php echo $form->error($model,'phone'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'subscribe_sms'); ?>
						<?php echo $form->checkbox($model,'subscribe_sms'); ?>
						<?php echo $form->error($model,'subscribe_sms'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'subscribe_mail'); ?>
						<?php echo $form->checkbox($model,'subscribe_mail'); ?>
						<?php echo $form->error($model,'subscribe_mail'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->passwordField($model,'password'); ?>
						<?php echo $form->error($model,'password'); ?>
					</li>
					<li>
						<?php echo $form->labelEx($model,'verifyPassword'); ?>
						<?php echo $form->passwordField($model,'verifyPassword'); ?>
						<?php echo $form->error($model,'verifyPassword'); ?>
					</li>
					
					<li>
						<?php echo CHtml::submitButton('Регистрация',array('class'=>'i-submit')); ?>
					</li>
				</ul>
				</dd>	
				<dl>
				<?php $this->endWidget(); ?>
				</div><!-- form -->
                
            </div>
        </div>

        <div class="coll right">
            <div class="modul first">

                    <p class="phone">+7 (343) 201-36-06</p>
                    <a href="#">
                        Услуги автоэвакуатора
                    </a>
            </div>
            <div class="modul second">
                    
                    <p class="question">Есть вопросы?<br>
                        <span>Напиши нам</span>
                    </p>
                    <a href="#">
                        Услуги автоэвакуатора
                    </a>
            </div>
        </div>  

        <div class="clear"></div>
    </div>
</div>