<?php

	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->getAssetsUrl('application').'/css/style.css');
	$cs->registerCssFile($this->getAssetsUrl('application').'/css/reset.css');
	$cs->registerCssFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.css');
	$cs->registerCssFile($this->getAssetsUrl('application').'/css/fancybox/jquery.fancybox.css');
	$cs->registerCssFile($this->getAssetsUrl('application').'/css/main.css?v1');
    $cs->registerCssFile($this->getAssetsUrl('application').'/css/jquery-ui.min.css');


	$cs->registerCoreScript('jquery');
    //$cs->registerScriptFile('http://code.jquery.com/jquery-1.11.0.min.js', CClientScript::POS_END);
    //$cs->registerScriptFile('http://code.jquery.com/jquery-1.11.0.min.js', CClientScript::POS_END);
	$cs->registerScriptFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.js', CClientScript::POS_END);
    $cs->registerScriptFile($this->getAssetsUrl('application').'/js/tinyscrollbar.js', CClientScript::POS_END);
    $cs->registerScriptFile($this->getAssetsUrl('application').'/js/jquery-ui.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl('application').'/js/jquery.maphilight.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl('application').'/js/jquery.fancybox.js', CClientScript::POS_END);
    $cs->registerScriptFile($this->getAssetsUrl('application').'/js/owl.carousel.min.js', CClientScript::POS_END);

	$cs->registerScriptFile($this->getAssetsUrl('application').'/js/script.js', CClientScript::POS_END);

	$assetUrl=$this->getAssetsUrl('application');

?><!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->title; ?></title>
		<!--[if IE]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div class="wrap">
		<!--sale-->
		<?=$this->renderPartial('//layouts/_diagnosticSlider')?>
		<!--sale End-->

		<!--header-->
        <header>
        	<a href="/" class="logo">
                <img src="<?=$assetUrl?>/images/lights.png" alt="" title="">
            </a>

        	<dl class="tel">
        		<dt>
        			<strong>Телефон</strong> <a class="dropDown" href="#">автозапчасти</a>
            <div class="dopMenu">
              <ul>
                <li>
                    <a href=".phone-1">первый</a> 
                </li>
                <li>
                    <a href=".phone-2">второй</a> 
                </li>
                <li>
                    <a href=".phone-3">третий</a> 
                </li>
              </ul>
            </div>
        		</dt>
        		<dd>
                    <div class="phone-1 active">
            			8-800-500-2019<br/>
    					+7(343) 288-22-88 
                    </div>
                    <div class="phone-2 ">
                        8-800-500-2019<br/>
                    </div>
                    <div class="phone-3">
                        +7(343) 288-22-88 
                    </div>
        		</dd>
        	</dl>

        	<dl class="qst-head">
                <dt>
                    <strong>Есть вопросы?</strong>
                </dt>
                <dd>
                    <a href="#popup" class="i-submit modal">
                        Задать вопрос
                    </a>
                </dd>
            </dl>

        	<div class="reg">
        			<ul>
                        <?
                            $authenticated=Yii::app()->user->isGuest || Yii::app()->user->isAdmin;
                        ?>
                    <?if ($authenticated){?>
        				<li>
        					<a class="auth" href="#login">Войти</a>
        				</li>
        				<li>
        					<a href="/account/registration">Регистрация</a>
        				</li>
                    <?}
                        else 
                    {?>
                        <li>
                            <a href="/account/">Личный кобинет</a>
                        </li>
                        <li>
                            <a href="/account/logout">Выйти</a>
                        </li>
                        <?}?>
        			</ul>
        	</div>

        	<dl class="bascet">	
                
        		<dt>
        			<strong>В корзине:</strong> 
        		</dt>
        		<dd>
        			<?
                        if (!Yii::app()->cart->isEmpty(1) && $authenticated)
                        {
                    ?><ul>
        				    <li>
        					<a href="/cart"><?=Yii::app()->cart->getItemsCount()?> товар</a>
        				    </li>
        				    <li>
                            <a href="/cart">
        					На сумму: <strong><?=Yii::app()->cart->getCost()?> руб.</strong>
                            </a>
        			     	</li>
        			  </ul>
                    <?} else {?>
                        <span class="empty-cart">
                            нет товаров
                        </span>
                    <?}?>
        		</dd>
                
        	</dl>

        </header>
        <!--header End-->

        <!--menu-->
        <div class="menu">

        		<nav>
                 <ul>
                    <?
                    $controller=Yii::app()->controller->id;
                    $action=Yii::app()->controller->action->id;
                    
                    if (!$action)
                        $action=$this->alias; 
                    $url="/$controller".($action ? "/$action" : '');    
                    $menu=array(
                            array('label'=>'О компании', 'url'=>'/page/about'),
                            array('label'=>'Продажа авто', 'url'=>'/catalog'),
                            array('label'=>'Автозапчасти', 'url'=>'/detail'),
                            array('label'=>'Все услуги', 'url'=>'/page/service'),
                            array('label'=>'Новости', 'url'=>'/news'),
                            array('label'=>'Контакты', 'url'=>'/page/contacts'),
                            array('label'=>'Вакансии', 'url'=>'/vacansy'),
                        );

                        foreach ($menu as $key => $item) {
                            ?>
                                <li class="<?=strpos($item['url'], $url)===0 ? 'active' : ''?>">
                                    <a href="<?=$item['url']?>"><?=$item['label']?></a>
                                </li>
                            <?
                        }
                    ?>
                    </ul>
	        		<!-- <ul>
	        			<li>
	        				<a href="/page/about">
	        					О компании
	        				</a>
	        			</li>
	        			<li>
	        				<a href="/catalog">
	        					Продажа авто
	        				</a>
	        			</li>
	        			<li>
	        				<a href="/detail">
	        					Автозапчасти
	        				</a>
	        			</li>
	        			<li>
	        				<a href="/page/Vse-uslugi">
	        					Все услуги
	        				</a>
	        			</li>
	        			<li>
	        				<a href="/news/">
	        					Новости
	        				</a>
	        			</li>
	        			<li class="active">
	        				<a href="/page/contacts">
	        					Контакты
	        				</a>
	        			</li>
	        			<li>
	        				<a href="/promotions">
	        					Акции
	        				</a>
	        			</li>
	        		</ul> -->
        		</nav>

        		<div class="search">
        			<input type="text" value="" placeholder="Введите ваш запрос"/>

        			<input type="button" id="searchBtn" value="По сайту" />
                    <label for="searchBtn">По сайту</label><span></span>
                    <div class="searchBy">
                        <ul>
                            <li>
                                Авто
                            </li>
                            <li>
                                По сайту
                            </li>
                            <li>
                                Автозапчасти
                            </li>
                        </ul>
                    </div>
        		</div>
            
        </div>
        <?if (strpos(get_class($this),"Site")!=-1){?>
            <div class="breacumbs fix_width" style="margin-top: 20px;">
            <?

                $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'separator'=>'<span>&rarr;</span>'
                ));
            ?>
            </div>
            <?}?>
		<div id="layout" class="fix_width">
		<?php echo $content;?>
		</div>

		 <footer>

    	<dl class="copy">
    		<dt>
    			© 2013 ООО «Авторазборка72»
    		</dt>
    		<dd>
    			Использование материалов сайта<br/> 
				без согласия правообладателя запрещено
    		</dd>
    	</dl>

    	<div class="mn">

    		<div class="nav">
    			<ul>
    				<li>
        				<a href="/page/about">
        					О компании
        				</a>
        			</li>
        			<li>
        				<a href="/catalog">
        					Продажа авто
        				</a>
        			</li>
        			<li>
        				<a href="/detail">
        					Автозапчасти
        				</a>
        			</li>
        			<li>
        				<a href="/page/Vse-uslugi">
        					Все услуги
        				</a>
        			</li>
        			<li>
        				<a href="/news">
        					Новости
        				</a>
        			</li>
        			<li class="active">
        				<a href="/page/Kontakty">
        					Контакты
        				</a>
        			</li>
    			</ul>	
    		</div>

    		<div class="block">

    			<div class="tel">
    				8-800-500-2019<br/>
					<a href="mailto:info@razbor72.ru">
						info@razbor72.ru
					</a>
    			</div>

    			<div class="search">
    				<input type="text" value="" placeholder="Поиск по сайту" />
    				<input type="submit" value="" class="i-submit"/>
    			</div>
    		</div>	
    	</div>
    	<div class="clear"></div>
    </footer>
    <?=$this->renderPartial('//forms/question',array('model'=>new Questions),true);?>
    <div class="over" id="hide-layout"></div>
    <?=$this->renderPartial('//account/login',array('model'=>new AuthForm),true)?>
    <?=$this->renderPartial('//forms/bookPart',array('model'=>new Bookpart));?>
	</body>
</html>
