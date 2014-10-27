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
                        <?
                            if ($this->message){
                        ?>
                        <div class="flash flash-info">
                            <?=$this->message?>
                        </div>
                        <?}?>
        				<div class="form <?=$tabActive == 1 ? 'tab-active' : 'hide'?>" id="phiz">
                            <?
                                if ($model->requests){
                            ?>
                                <a href="/account/entry_list" class="cart-list">Список заказов</a>
                            <?}?>
        					<?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'ownPrice-form',
                                'action' => $this->createUrl('/account'),
                                'enableClientValidation' => false,
                                'clientOptions' => array(
                                    //'validateOnType' => false,
                                    'validateOnSubmit'=>true,
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
                                        <?php echo $form->textField($model,'fio',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
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
                                        <label>
                                            Подписаться<br> на e-mail<br> рассылку
                                        </label>
                                        <div class="group">
                                            <!-- <input hidden="" type="checkbox" id="check1"> -->
                                            <?=$form->checkBox($model,'subscribe_news',array('hidden'=>true))?>
                                            <label for="Clients_subscribe_news">
                                                <span></span>
                                                На новости
                                            </label>

                                            <?=$form->checkBox($model,'subscribe_new',array('hidden'=>true))?>
                                            <label for="Clients_subscribe_new"><span>
                                                  
                                                </span>
                                                  На новинки
                                            </label>
                                            <!-- <input hidden="" type="checkbox" name="check" id="check3">
                                            <label for="check3">
                                            <span></span>
                                                На новинки
                                            </label> -->
                                        </div>  
                                    </li>
                                </ul>
                                </dd>
                                        <dt>Данные акаунта</dt>
                                    <dd>

                                        <ul>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'oldPassword');?>
                                        <?php echo $form->passwordField($changePwd,'oldPassword',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'oldPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'password');?>
                                        <?php echo $form->passwordField($changePwd,'password',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'password',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'verifyPassword');?>
                                        <?php echo $form->passwordField($changePwd,'verifyPassword',array('class'=>'i-text','maxlength'=>255)); ?>
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
                            
                            <?
                                if ($model->requests){
                            ?>
                                <a href="/account/entry_list" class="cart-list">Список заказов</a>
                            <?}?>

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
                                        <?php echo $form->textField($model,'fio',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($model,'fio',array('style'=>'color:red;font-size:10px;'));?>
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
                                        <label>
                                            Подписаться<br> на e-mail<br> рассылку
                                        </label>
                                        <div class="group">
                                            <!-- <input hidden="" type="checkbox" id="check1"> -->
                                            <?=$form->checkBox($model,'subscribe_news',array('hidden'=>true,'id'=>'news'))?>
                                            <label for="news">
                                                <span></span>
                                                На новости
                                            </label>

                                            <?=$form->checkBox($model,'subscribe_new',array('hidden'=>true,'id'=>'new'))?>
                                            <label for="new"><span>
                                                  
                                                </span>
                                                  На новинки
                                            </label>
                                            <!-- <input hidden="" type="checkbox" name="check" id="check3">
                                            <label for="check3">
                                            <span></span>
                                                На новинки
                                            </label> -->
                                        </div>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'name_company');?>
                                        <?php echo $form->textField($info,'name_company',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'name_company',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'inn');?>
                                        <?php echo $form->textField($info,'inn',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'inn',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'kpp');?>
                                        <?php echo $form->textField($info,'kpp',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'kpp',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'ur_address');?>
                                        <?php echo $form->textField($info,'ur_address',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'ur_address',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($info,'address');?>
                                        <?php echo $form->textField($info,'address',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($info,'address',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                </ul>
                                </dd>
                                        <dt>Данные акаунта</dt>
                                    <dd>
                                        <ul>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'oldPassword');?>
                                        <?php echo $form->passwordField($changePwd,'oldPassword',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'oldPassword',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'password');?>
                                        <?php echo $form->passwordField($changePwd,'password',array('class'=>'i-text','maxlength'=>255)); ?>
                                        <?php echo $form->error($changePwd,'password',array('style'=>'color:red;font-size:10px;'));?>
                                    </li>
                                    <li>
                                        <?php echo $form->labelEx($changePwd,'verifyPassword');?>
                                        <?php echo $form->passwordField($changePwd,'verifyPassword',array('class'=>'i-text','maxlength'=>255)); ?>
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

        		<div class="clear"></div>
        	</div>
        </div>	