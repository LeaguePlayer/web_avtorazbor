<div class="service" id="panel">
    <ul>
        <li class="icon sale">
            <a href="/catalog">
                <i></i>
                <span class="h">Продажа авто</span>
                <span class="d">Крупнейший парк<br/> битых авто в Тюмени</span>
            </a>
        </li>
        <li class="icon zp">
            <a href="/detail">
                <i></i>
                <span class="h">Автозапчасти</span>
                <span class="d">Огромный выбор<br/> запчастей с разбора</span>
            </a>
        </li>
        <li class="icon buying">
            <a href="/buyout">
                <i></i>
                <span class="h">Выкуп авто</span>
                <span class="d">Выкуп автомобилей<br/> после ДТП, пожара и т.п.</span>
            </a>
        </li>
        <li class="icon med">
            <a href="/evackuator">
                <i></i>
                <span class="h">Эвакуатор</span>
                <span class="d">Эвакуируем авто<br/> из любой точки города</span>
            </a>
        </li>
        <li class="icon transport">
            <a href="/page/Avtoperevozki">
                <i></i>
                <span class="h">Автоперевозки</span>
                <span class="d">Автомобильные перевозки<br/>
                в Тюмени и области</span>
            </a>
        </li>
    </ul>
</div>
<!--service End-->

<!--search-->

<div class="s-big searchform">
    <div class="tabs">
        <ul>
            <li class="active">
                <a href="#tabs-1" data-url="/catalog">
                    Легковые авто
                </a>
            </li>
            <?
                if ($BrandsWeightCars)
                {
            ?>
            <li>
                <a href="#tabs-2" data-url="/catalog?Search[type]=weight&Search[scenario]=weight">
                    Грузовые авто
                </a>
            </li>
            <?}?>
            <li>
                <a href="#tabs-3" data-url="/parts">
                    Автозапчасти
                </a>    
            </li>
            <li>
                <a href="#book" class="modal">
                    Заказать деталь
                </a>    
            </li>
        </ul>
    </div>

   <?=$this->renderPartial('//forms/question',array('model'=>new Questions),true);?>

    <div class="parametr tab-active" id="tabs-1">

       <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => $this->createUrl('/search/getCars'),
                'htmlOptions' => array('class' => 'search-text')
            ));
            echo CHtml::hiddenField('type','1');
        ?>
        <input type="text" data-model="UsedCars" data-type="1" class="searching"  placeholder="Введите Ваш запрос" value="<?=$_GET['query']?>">
        <?
            echo CHtml::ajaxSubmitButton('','/search/getCars',
                array(
                    'url'=>'/search/getCars',
                    'type'=>'GET',
                    'data'=>'js:{type:1,str:$(".searching",$("#tabs-1")).val()}',
                    'success'=>'function(data){
                        $(".items-auto").remove();
                        $(".cat-auto").append(data)
                        $(".items-auto .items").owlCarousel();
                    }'
                )
            );
        ?>

        <?$this->endWidget();?>

        <div class="coll">
            <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form-light',
    'action' => $this->createUrl('/site/index'),
    'htmlOptions' => array('class' => 'request_form')
)) ?>
            <div class="coll-2">
                
                <dl>
                    <dt>
                        Марка
                    </dt>
                    <dd>
                        <input type="hidden" value="1" name="Search[type]">
                        <?=$form->hiddenField($searchForm,'scenario',array('value' => 'light'));?>
                        <?=$form->dropDownList($searchForm, 'brand', $Brands, array( 
                                                'empty'=>'Выберите марку', 
                                                'class'=>'select',
                                                'data-nested'=>'#carModels',
                                                'data-model'=>'carBrands',
                                                'data-next'=>'#carModels',
                                                'data-enabled'=>true,
                                                )
                                            );?>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Модель
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                'empty'=>'Выберите модель', 'class'=>'select','id'=>'carModels','data-model'=>'carModels','data-map'=>true));?>
                    </dd>
                </dl>
                <dl class="otdo">
                    <dt>
                        Год выпуска:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                   <?=$form->textField($searchForm,'year_st' )?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'year_end' )?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl >
                    <dt>
                        Цена (тыс. руб.):
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st' )?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_end' )?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>

                
            </div>

            <div class="coll-2">
                <dl>
                    <dt>
                        Тип КПП:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'transmission', $Transmission, array( 
                                'empty'=>'Тип каробки передач', 'class'=>'select','id'=>'transmission'));
                        ?>
                    </dd>
                    <dt>
                        Пробег:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_st')?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_end')?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Тип кузова:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'bascet', $Bascet, array( 
                                'empty'=>'Выберите марку', 'class'=>'select','id'=>'bascet'));
                        ?>
                        
                    </dd>
                    <dt>
                        Состояние:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'state', $State, array( 
                                'empty'=>'Состояние', 'class'=>'select','id'=>'state'));
                        ?>
                    </dd>
                </dl>
                
                
            </div>
            
            <div class="coll-3">
                <dl>
                    <dt>
                        Найдено<br/>
                        <span class="num">
                            <?=$result['count']?> Авто
                        </span>
                    </dt>
                    <dd>
                        <a data-url="/catalog" href="/catalog" class="i-submit" >Показать</a>
                    </dd>
                </dl>
            </div>
            <?php $this->endWidget(); ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="parametr" id="tabs-2">

          <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => $this->createUrl('/search/getCars'),
                'htmlOptions' => array('class' => 'search-text')
            ));
            //echo $form->hiddenField('type',2);
            ?>

            <input type="text" data-model="UsedCars" data-type="2" class="searching" placeholder="Введите Ваш запрос"  value="<?=$_GET['query']?>">
            <?
            echo CHtml::hiddenField('type','1');
        ?>
        <?
            echo CHtml::ajaxSubmitButton('','/search/getCars',
                array(
                    'url'=>'/search/getCars',
                    'type'=>'GET',
                    'data'=>'js:{type:2,str:$(".searching",$("#tabs-2")).val()}',
                    'success'=>'function(data){
                        $(".items-auto").remove();
                        $(".cat-auto").append(data)
                        $(".items-auto .items").owlCarousel();
                    }'
                )
            );
        ?>
         <?$this->endWidget();?>
        <div class="coll">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form-weight',
                'action' => $this->createUrl('/site/index'),
                'htmlOptions' => array('class' => 'request_form')
            )) ;?>
                <div class="coll-2">
                
                <dl>
                    <dt>
                        Марка
                    </dt>
                    <dd>
                        <input type="hidden" value="1" name="Search[type]">
                        <?=$form->hiddenField($searchForm,'scenario',array('value' => 'weight'));?>
                        <?=$form->dropDownList($searchForm, 'brand', $BrandsWeightCars, array( 
                                                'empty'=>'Выберите марку', 
                                                'class'=>'select',
                                                'data-nested'=>'#carModels',
                                                'data-model'=>'carBrands',
                                                'data-next'=>'#carModels',
                                                'data-enabled'=>true,
                                            )
                                        );?>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Модель
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                'empty'=>'Выберите модель', 'class'=>'select','id'=>'carModels','data-model'=>'carModels','data-map'=>true));?>
                    </dd>
                </dl>
                <dl  class="otdo">
                    <dt>
                        Год выпуска:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                   <?=$form->textField($searchForm,'year_st' )?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'year_end' )?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Цена (тыс. руб.):
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st' )?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_end' )?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>

            <div class="coll-2">
               <dl>
                    <dt>
                        Тип кузова:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'bascet', $Bascet, array( 
                                'empty'=>'Выберите марку', 'class'=>'select','id'=>'bascet'));
                        ?>
                    </dd>
                    <dt>
                        Состояние:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'state', $State, array( 
                                'empty'=>'Состояние', 'class'=>'select','id'=>'state'));
                        ?>
                    </dd>
                </dl>
                <dl>
                    
                    <dt>
                        Пробег:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_st')?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_end')?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
                
            </div>

            <div class="coll-3">
                <dl>
                    <dt>
                        Найдено<br/>
                        <span class="num">
                            0 авто
                        </span>
                    </dt>
                    <dd>
                        <a data-url="/catalog" href="/catalog" class="i-submit" >Показать</a>
                    </dd>
                </dl>
            </div>
            <?php $this->endWidget(); ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="parametr" id="tabs-3">

           <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => $this->createUrl('/search/getCars'),
                'htmlOptions' => array('class' => 'search-text')
            ));
            //echo $form->hiddenField('type',2);
        ?>

            <input type="text" data-model="Parts" data-type="1" class="searching" placeholder="Введите Ваш запрос"  value="<?=$_GET['query']?>">
        <?
            echo CHtml::ajaxSubmitButton('','/search/getParts',
                array(
                    'url'=>'/search/getParts',
                    'type'=>'GET',
                    'data'=>'js:{type:$("#Search_type option:selected",$("#tabs-3")).val(),str:$(".searching",$("#tabs-3")).val(),table:"Parts"}',
                    'success'=>'function(data){
                        $(".items-auto").remove();
                        $(".cat-auto").append(data)
                        $(".items-auto .items").owlCarousel();
                    }'
                )
            );
        ?>
        <?$this->endWidget();?>
        
        <div class="coll">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form-weight',

                'action' => $this->createUrl('/site/index'),
                'htmlOptions' => array('class' => 'request_form','data-form'=>'Parts',)
            )) ?>
                <div class="coll-2">
                
                <dl class="full-width">
                    <dt>
                        Тип
                    </dt>
                    <dd>
<!--                         <input type="hidden" value="2" name="Search[type]"> -->
                        <?=$form->hiddenField($searchForm,'scenario',array('value' => 'parts'))?>

                        <?
                            $types=array(1=>'Запчасти для легковых машин');
                            if ($BrandsWeightPartsExists)
                                $types[]='Запчасти для грузовых машин';
                        ?>
                        <?=$form->dropDownList($searchForm, 'type', $types, array( 
                                                'empty'=>'Выберите тип авто', 
                                                'class'=>'select',
                                                'data-nested'=>'#carBrands',
                                                'data-model'=>'Type',
                                                'data-next'=>"#carBrands",
                                                'data-enabled'=>true,
                                            )
                                        );?>
                    </dd>
                </dl>
                <span></span>
                <dl>
                    <dt>
                        Марка
                    </dt>
                    <dd>
                        
                        <?=$form->dropDownList($searchForm, 'brand', $BrandsParts, array( 
                                                'empty'=>'Выберите марку', 
                                                'class'=>'select',
                                                'data-nested'=>'#carModels',
                                                'data-model'=>'carBrands',
                                                'id'=>'carBrands',
                                                'data-next'=>"#carModels",
                                                'data-enabled'=>true
                                            )
                                        );?>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Модель
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                'empty'=>'Выберите модель', 
                                                'class'=>'select',
                                                'id'=>'carModels',
                                                'data-nested'=>'#Categories',
                                                'data-model'=>'carModels',
                                                'data-map'=>false,
                                                'data-next'=>"#Categories",
                                                
                                            )
                                        );?>
                    </dd>
                </dl>
            </div>
            
            <div class="coll-1">
                <dl class="full-width">
                    
                    <dt>
                        Раздел:
                    </dt>
                    <dd>
                        <?=$form->dropDownList($searchForm, 'parent', array(), array( 
                                'empty'=>'Разедл', 'class'=>'select','id'=>'Categories'));
                        ?>
                    </dd>
                </dl>
                <dl class="otdo">
                    <dt>
                        Цена (тыс. руб.):
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st' )?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_end' )?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
                
            </div>

            <div class="coll-3">
                <dl>
                    <dt>
                        Найдено<br/>
                        <span class="num">
                            42 Запчасти
                        </span>
                    </dt>
                    <dd>
                        <a data-url="/parts" href="/parts" class="i-submit" >Показать</a>
                    </dd>
                </dl>
            </div>
            <?php $this->endWidget(); ?>
            <div class="clear"></div>
        </div>
    </div>
    <div class="parametr" id="tabs-4">

          <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => $this->createUrl('/search/getCars'),
                'htmlOptions' => array('class' => 'search-text')
            ));
            //echo $form->hiddenField('type',2);
            echo CHtml::hiddenField('type','1');
        ?>

        <?
            echo CHtml::ajaxSubmitButton('','/search/getCars',
                array(
                    'url'=>'/search/getCars',
                    'type'=>'GET',
                    'data'=>'js:{type:1,str:$("#searching",this).val(),table:"UsedCars"}',
                    'success'=>'function(data){
                        $(".items-auto").remove();
                        $(".cat-auto").append(data)
                        $(".items-auto .items").owlCarousel();
                    }'
                )
            );
        ?>
        <?$this->endWidget();?>

        <div class="coll">

            <div class="coll-1">

                <dl>
                    <dt>
                        Марка
                    </dt>
                    <dd>
                        <select name="Mark">
                            <option value="0">
                                Alfa Romeo
                            </option>
                            <option value="1">
                                BMW
                            </option>
                            <option value="2">
                                Audi
                            </option>
                        </select>
                    </dd>
                </dl>

                <dl class="otdo">
                    <dt>
                        Цена (тыс. руб.):
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <input type="text" value="" placeholder="100" />
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <input type="text" value="" placeholder="" />
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>

                <dl class="otdo">
                    <dt>
                        Год выпуска:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <input type="text" value="" placeholder="2006" />
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <input type="text" value="" placeholder="" />
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>

            <div class="coll-2">
                <dl>
                    <dt>
                        Тип кузова:
                    </dt>
                    <dd>
                        <select name="Country">
                            <option value="0">
                                Выберите тип кузова
                            </option>
                            <option value="1">
                                Седан
                            </option>
                            <option value="2">
                                Хэтчбэк
                            </option>
                            <option value="3">
                                Универсал
                            </option>
                        </select>
                    </dd>
                    <dt>
                        Состояние:
                    </dt>
                    <dd>
                        <select name="Sost">
                            <option value="0">
                                Состояние
                            </option>
                            <option value="1">
                                Отлично
                            </option>
                            <option value="2">
                                Хорошее
                            </option>
                            <option value="3">
                                Среднее
                            </option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        Тип КПП:
                    </dt>
                    <dd>
                        <select name="transmission">
                            <option value="0">
                                Выберите тип КПП
                            </option>
                            <option value="1">
                                Автомат
                            </option>
                            <option value="2">
                                Робот
                            </option>
                            <option value="3">
                                Механика
                            </option>
                        </select>
                    </dd>
                    <dt>
                        Пробег:
                    </dt>
                    <dd>
                        <ul>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_st',array('class'=>'i-text'))?>
                                </div>
                            </li>
                            <li>
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'mileage_end',array('class'=>'i-text'))?>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>

            <div class="coll-3">
                <dl>
                    <dt>
                        Найдено<br/>
                        <span class="num">
                            42 авто
                        </span>
                    </dt>
                    <dd>
                        <a data-url="/parts" href="/parts" class="i-submit" >Показать</a>
                    </dd>
                </dl>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--search End-->

<!--cat. auto-->
<div class="cat-auto">
    <a href="#" class="prev">
    </a>
    <a href="#" class="next">
    </a>
    <img class="loader" src="/media/images/loader-fff.gif"/>
    <?=$this->renderPartial('//site/carCarusel',array('dataProvider'=>$dataProviderCar),true);?>

    <div class="clear"></div>
</div>
<div class="readmore">
    <a href="/catalog" class="i-submit">Все легковые автомобили</a>
</div>
<!--cat auto End-->

<!--page-->
<div class="page new">
    <div class="wr">

        <div class="coll left">
            <div class="tabs">
                <ul>
                    <li class="active">
                        <a href="#tabs-5">
                            Поступили в продажу
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-6">
                            Поступили в разбор
                        </a>
                    </li>
                </ul>
            </div>

            <div class="content clear">
                <div id="tabs-5" class="tab-active">
                    <a href="#" class="prev"></a>
                    <a href="#" class="next"></a>
                    <?=$this->renderPartial('/site/newsCarusel',array('dataProvider'=>$cars))?>
                </div>
                <div id="tabs-6">
                    <a href="#" class="prev"></a>
                    <a href="#" class="next"></a>
                    <?=$this->renderPartial('/site/newsCarusel',array('dataProvider'=>$razbor))?>
                </div>
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
<!--page End-->

<!--about-->
<div class="about">
    <h1>
        О компании
    </h1>
    <p>
        Добро пожаловать в интернет-магазин компании «Разбор72». Мы предлагаем самый  широкий ассортимент авторазбора  в Тюмени на любые марки автомобилей по адекватным ценам. Покупая и запчасти в нашем Интернет-магазине, вы можете быть уверены в качестве — ведь мы работаем только с крупными
и проверенными производителями.
    </p>
    <p>         
        Благодаря широкой партнерской сети наш каталог постоянно пополняется иномарками европейского, японского и китайского производства.Если вы нигде не можете найти необходимую деталь — оставьте заявку на индивидуальный подбор, мы найдем авторазборку в самые короткие сроки.
    </p>
</div>
<div class="clear"></div>
<div class="readmore">
        <a href="/page/Sotrunichestvo" class="i-submit">
            Узнать о сотрудничестве
        </a>
    </div>
<!--about End-->

<!--plus-->
<div class="plus">
    <ul class="list">
        <li class="park">
            <i></i>
            Самый большой парк<br/>
            битых авто в Тюмени
        </li>
        <li class="grnt">
            <i></i>
            Гарантия и 100%<br/> 
            юридической чистоты
        </li>
        <li class="serv">
            <i></i>
            Удобный сервис и<br/>
            качественное обслуживание
        </li>
        <li class="sale">
            <i></i>
            Скидки и индивидуальный<br/>
            подход к каждому клиенту
        </li>
    </ul>
</div>
<!--plus End-->
