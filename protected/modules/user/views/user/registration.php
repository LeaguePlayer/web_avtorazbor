<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>


<div class="page">
            <h1 class="head">
                <?php echo UserModule::t("Registration"); ?>
            </h1>

            <div class="wr">

                <div class="coll left">

                    <div class="content clear">

						<?php if(Yii::app()->user->hasFlash('registration')): ?>
						<div class="success">
						<?php echo Yii::app()->user->getFlash('registration'); ?>
						</div>
						<?php else: ?>

						<div class="form">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'registration-form',
							'action'=>'/user/registration',
							'htmlOptions' => array('enctype'=>'multipart/form-data'),
						)); ?>
						<ul>
							<li>
								<?php echo $form->labelEx($model,'username'); ?>
								<?php echo $form->textField($model,'username'); ?>
								<?php echo $form->error($model,'username'); ?>
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
								<?php echo $form->labelEx($model,'tel'); ?>
								<?php echo $form->textField($model,'tel'); ?>
								<?php echo $form->error($model,'tel'); ?>
							</li>
							<li>
								<?php echo $form->labelEx($model,'city'); ?>
								<?php echo $form->textField($model,'city'); ?>
								<?php echo $form->error($model,'city'); ?>
							</li>
							<li>
								<?php echo $form->labelEx($model,'distribution_sms'); ?>
								<?php echo $form->checkbox($model,'distribution_sms'); ?>
								<?php echo $form->error($model,'distribution_sms'); ?>
							</li>
							<li>
								<?php echo $form->labelEx($model,'distribution_mail'); ?>
								<?php echo $form->checkbox($model,'distribution_mail'); ?>
								<?php echo $form->error($model,'distribution_mail'); ?>
							</li>
							<li>
								<?php echo CHtml::submitButton(UserModule::t("Register"),array('class'=>'i-submit')); ?>
							</li>
						</ul>

						<?php $this->endWidget(); ?>
						</div><!-- form -->
						<?php endif; ?>
                        
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