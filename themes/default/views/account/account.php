<div class="page">
        	<h1 class="head">
        		Мой данные
        	</h1>
        	<div class="wr">

        		<div class="coll left">

        			<div class="tabs">
        				<ul>
        					<li <?= $tabActive == 1  ? 'class="active"' : ''?>>
        						<a href="#phiz">
        							Физическое лицо
        						</a>
        					</li>
        					<li <?= $tabActive == 2  ? 'class="active"' : ''?>>
        						<a href="#law">
        							Юридическое лицо
        						</a>	
        					</li>
        				</ul>
        			</div>

        			<div class="content clear">

        				<div class="form <?=$tabActive == 1 ? 'tab-active' : 'hide'?>" id="phiz">
                            <a href="/account/entry_list" class="cart-list">Список заказов</a>
        					<?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'ownPrice-form',
                                'action' => $this->createUrl('/account'),
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnType' => true,
                                ),
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                            <dl>
                                <dt>Личные данные</dt>
                            <dd>
                                <ul>
                                    <li>
                                        <input name="tabActive" type="hidden" value="1">
                                        <?php echo $form->labelEx($model,'fio');?>
                                        <?php echo $form->textField($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'phone');?>
                                        <?php echo $form->textField($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'email');?>
                                        <?php echo $form->textField($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'subscribe_mail');?>
                                        <?php echo $form->checkbox($model,'subscribe_mail',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'subscribe_mail',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'subscribe_sms');?>
                                        <?php echo $form->checkbox($model,'subscribe_sms',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'subscribe_sms',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                </ul>
                                </dd>
                                        <dt>Данные акаунта</dt>
                                    <dd>
                                        <ul>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'oldPassword');?>
                                        <?php echo $form->textField($changePwd,'oldPassword',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'oldPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'password');?>
                                        <?php echo $form->textField($changePwd,'password',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'password',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'verifyPassword');?>
                                        <?php echo $form->textField($changePwd,'verifyPassword',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'verifyPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?=CHtml::submitButton('Сохранить',array('class'=>'i-submit'))?>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <?php $this->endWidget(); ?>
                		</div>
                        <div class="form <?=$tabActive == 2 ? 'tab-active' : 'hide'?>" id="law">
                            <a href="/account/entry_list" class="cart-list">Список заказов</a>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'law-form',
                                'action' => $this->createUrl('/account'),
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnType' => true,
                                ),
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                            <dl>
                                <dt>Личные данные</dt>
                            <dd>
                                <ul>
                                    <li>
                                        <input name="tabActive" type="hidden" value="2">
                                        <?php echo $form->labelEx($model,'fio');?>
                                        <?php echo $form->textField($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'phone');?>
                                        <?php echo $form->textField($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'phone',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'email');?>
                                        <?php echo $form->textField($model,'email',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'subscribe_mail');?>
                                        <?php echo $form->checkbox($model,'subscribe_mail',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'subscribe_mail',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($model,'subscribe_sms');?>
                                        <?php echo $form->checkbox($model,'subscribe_sms',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'subscribe_sms',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'name_company');?>
                                        <?php echo $form->textField($info,'name_company',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'name_company',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'inn');?>
                                        <?php echo $form->textField($info,'inn',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'inn',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'kpp');?>
                                        <?php echo $form->textField($info,'kpp',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'kpp',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'ur_address');?>
                                        <?php echo $form->textField($info,'ur_address',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'ur_address',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'address');?>
                                        <?php echo $form->textField($info,'address',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'address',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                </ul>
                                </dd>
                                        <dt>Данные акаунта</dt>
                                    <dd>
                                        <ul>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'oldPassword');?>
                                        <?php echo $form->textField($changePwd,'oldPassword',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'oldPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'password');?>
                                        <?php echo $form->textField($changePwd,'password',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'password',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'verifyPassword');?>
                                        <?php echo $form->textField($changePwd,'verifyPassword',array('class'=>'span8','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'verifyPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?=CHtml::submitButton('Сохранить',array('class'=>'i-submit'))?>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <?php $this->endWidget(); ?>
                        </div>
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
        <div class="messages">
            <p class="content">
                <?=$this->message?>
            </p>
        </div>