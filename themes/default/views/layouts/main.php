<?php
    $assetUrl=$this->getAssetsUrl('application');
	$cs = Yii::app()->clientScript;

    $assetsUrl=$this->getAssetsUrl('application');
	$cs->registerCssFile($assetsUrl.'/css/style.css');
	$cs->registerCssFile($assetsUrl.'/css/reset.css');
	$cs->registerCssFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.css');
	$cs->registerCssFile($assetsUrl.'/css/fancybox/jquery.fancybox.css');
	$cs->registerCssFile($assetsUrl.'/css/main.css?v1');
    $cs->registerCssFile($assetsUrl.'/css/jquery-ui.min.css');
	$cs->registerCoreScript('jquery');
	$cs->registerScriptFile('http://fotorama.s3.amazonaws.com/4.4.9/fotorama.js', CClientScript::POS_END);
    $cs->registerScriptFile($assetsUrl.'/js/tinyscrollbar.js', CClientScript::POS_END);
    $cs->registerScriptFile($assetsUrl.'/js/scrollTo.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($assetsUrl.'/js/jquery-ui.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($assetsUrl.'/js/jquery.autocomplete.js', CClientScript::POS_END);
	$cs->registerScriptFile($assetsUrl.'/js/jquery.maphilight.js', CClientScript::POS_END);
	$cs->registerScriptFile($assetsUrl.'/js/jquery.fancybox.js', CClientScript::POS_END);
    $cs->registerScriptFile($assetsUrl.'/js/owl.carousel.min.js', CClientScript::POS_END);

	$cs->registerScriptFile($assetsUrl.'/js/script.js', CClientScript::POS_END);
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
            <div class="wrap">
            	<a href="/" class="logo">
                    <img src="<?=$assetUrl?>/images/lights.png" alt="" title="">
                </a>

            	<dl class="tel">
            		<dt>
            			<strong>Телефон</strong> <a class="dropDown" href="#"><span><?=Settings::getModelBlyAlias('phone_parts')->label?></span><span></span></a>
                <div class="dopMenu">
                  <ul>
                    <li>
                        <a href=".phone-1"><?=Settings::getModelBlyAlias('phone_parts')->label?></a> 
                    </li>
                    <li>
                        <a href=".phone-2"><?=Settings::getModelBlyAlias('buy_car')->label?></a> 
                    </li>
                    <li>
                        <a href=".phone-3"><?=Settings::getModelBlyAlias('sales')->label?></a> 
                    </li>
                    <li>
                        <a href=".phone-4"><?=Settings::getModelBlyAlias('evacuator_phone')->label?></a> 
                    </li>
                  </ul>
                </div>
            		</dt>
            		<dd>
                        <div class="phone-1 active">
                			<?=Settings::getValue('phone_parts')?>
                        </div>
                        <div class="phone-2 ">
                            <?=Settings::getValue('buy_car')?>
                        </div>
                        <div class="phone-3">
                            <?=Settings::getValue('sales')?>
                        </div>
                        <div class="phone-4">
                            <?=Settings::getValue('evacuator_phone')?>
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
                <?if (!Yii::app()->user->isAdmin){
            	   $this->renderPartial('//layouts/_reg');
            	   $this->renderPartial('//layouts/_cart');
                } else {
                    $this->renderPartial('//layouts/_adminMessage');
                }?>
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
                    </nav>

                    <form action="/search/find" class="search">
                        <input type="text" autocomplete="off" value="" name="str" placeholder="Введите ваш запрос"/>
                        <input hidden type="radio" name="table" <?=!isset($_GET['table']) || $_GET['table']=='UsedCars'  ? 'checked' : ''?> id="UsedCars" value="UsedCars" />
                        <input hidden type="radio" name="table" <?=$_GET['table']=='Parts' ? 'checked' : ''?> id="Parts" value="Parts" />
                        <div class="searchType"><?=!$_GET['table'] || $_GET['table']=='UsedCars' ? 'Авто' : "Автозапчасти" ?></div>
                        <span></span>
                        <div class="searchBy">
                            <ul>
                                <li>
                                    <label for="UsedCars">Авто</label>
                                </li>
                                <li>
                                    <label for="Parts">Автозапчасти</label>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                </div>
        </header>
        <!--header End-->

        <!--menu-->
        
        <?if (strpos(get_class($this),"Site")==false){?>
            <div class="breacumbs fix_width">
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
        				<a href="/page/service">
        					Все услуги
        				</a>
        			</li>
        			<li>
        				<a href="/news">
        					Новости
        				</a>
        			</li>
        			<li class="active">
        				<a href="/page/contacts">
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

    			<form action="/search/find" class="search">
                    <input autocomplete="off" type="text" value="" name="str" placeholder="Введите ваш запрос"/>
                    <input type="submit" value=""/>
                    <input hidden type="radio" name="table" checked value="Parts" />
                </form>
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
