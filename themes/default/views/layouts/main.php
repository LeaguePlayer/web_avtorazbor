<?php

	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/reset.css');
	$cs->registerCssFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/compactmenu.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/main.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/jquery.ui/overcast/jquery-ui-1.10.3.custom.min.css');
	//$cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox-buttons.css');
	
	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	
	//$cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.fancybox-buttons.js', CClientScript::POS_END);
	//$cs->registerScriptFile('http://api-maps.yandex.ru/2.0.27/?load=package.standard&lang=ru-RU', CClientScript::POS_HEAD);
	
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.timepicker.addon.js', CClientScript::POS_END);
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.ui.timepicker.ru.js', CClientScript::POS_END);
	// $cs->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', CClientScript::POS_END);
	$cs->registerScriptFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.js', CClientScript::POS_END);
    $cs->registerScriptFile($this->getAssetsUrl().'/js/tinyscrollbar.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery-ui.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.maphilight.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.selectbox.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.js', CClientScript::POS_END);
    $cs->registerScriptFile($this->getAssetsUrl().'/js/owl.carousel.min.js', CClientScript::POS_END);

	$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js', CClientScript::POS_END);
	
	$assetUrl=$this->getAssetsUrl();
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
		<div class="sale fotorama">
			<div class="item">
                <img src="<?=$assetUrl?>/images/header.png" width="100%" alt="" title="" />
                    <div class="info">
                        <p class="caption">
                            Компьютерная <strong>диагностика авто</strong>
                        </p>
                        <p class="feature">Компьютерная диагностика двигателя  /  Исправление системных ошибок
                        </p>
                        <p class="phone">
                            <span>+7 (343)</span> 288-22-88
                        </p>
                        <a href="more">Подробнее</a>
                    </div>
			</div>
			<div class="item">
                <img src="<?=$assetUrl?>/images/header.png" width="100%" alt="" title="" />
                    <div class="info">
                        <p class="caption">
                            Компьютерная <strong>диагностика авто</strong>
                        </p>
                        <p class="feature">Компьютерная диагностика двигателя  /  Исправление системных ошибок</p>
                        <p class="phone">
                            <span>+7 (343)</span> 288-22-88
                        </p>
                        <a href="more">Подробнее</a>
                    </div>
            </div>
            <div class="item">
                <img src="<?=$assetUrl?>/images/header.png" width="100%" alt="" title="" />
                    <div class="info">
                        <p class="caption">
                            Компьютерная <strong>диагностика авто</strong>
                        </p>
                        <p class="feature">Компьютерная диагностика двигателя  /  Исправление системных ошибок</p>
                        <p class="phone">
                            <span>+7 (343)</span> 288-22-88
                        </p>
                        <a href="more">Подробнее</a>
                    </div>
            </div>
		</div>
		<!--sale End-->

		<!--header-->
        <header>
        	<a href="/" class="logo">
                <img src="../<?=$assetUrl?>/images/lights.png" alt="" title="">
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

        	<dl class="qst">
                <dt>
                    <strong>Есть вопросы?</strong>
                </dt>
                <dd>
                    <a href="#popup" name="qst" class="i-submit">
                        Задать вопрос
                    </a>
                </dd>
            </dl>

        	<div class="reg">
        			<ul>
        				<li>
        					<a href="#">Войти</a>
        				</li>
        				<li>
        					<a href="#">Регистрация</a>
        				</li>
        			</ul>
        	</div>

        	<dl class="bascet">	
        		<dt>
        			<strong>В корзине:</strong> 
        		</dt>
        		<dd>
        			<ul>
        				<li>
        					<a href="#">1 товар</a>
        				</li>
        				<li>
        					На сумму: <strong>6 500 руб.</strong>
        				</li>
        			</ul>
        		</dd>
        	</dl>

        </header>
        <!--header End-->

        <!--menu-->
        <div class="menu">

        		<nav>
                <?$this->widget('zii.widgets.CMenu', array(
                    'items'=>array(
                        // Important: you need to specify url as 'controller/action',
                        // not just as 'controller' even if default acion is used.
                        array('label'=>'О компании', 'url'=>array('/page/about')),
                        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
                        array('label'=>'Продажа авто', 'url'=>array('/catalog')), 
                        array('label'=>'Автозапчасти', 'url'=>array('/detail')),
                        array('label'=>'Все услуги', 'url'=>array('/page/Vse-uslugi')),
                        array('label'=>'Новости', 'url'=>array('/news')),
                        array('label'=>'Контакты', 'url'=>array('/page/contacts')),
                        array('label'=>'Акции', 'url'=>array('/promotions')),
                    ),
                ));?>
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
        			<li>
        				<a href="#">
        					Акции
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
	</body>
</html>
