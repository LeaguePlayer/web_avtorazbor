        <div class="service" id="panel">
            <ul>
                        <li class="icon sale">
                            <a href="/catalog">
                                <i></i>
                                <span class="h">Продажа авто</span>
                                <span class="d">Крупнейший парк<br/> битых авто в Екатеринбурге</span>
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
                            <a href="/sales">
                                <i></i>
                                <span class="h">Выкуп авто</span>
                                <span class="d">Выкуп автомобилей<br/> после ДТП, пожара и т.п.</span>
                            </a>
                        </li>
                        <li class="icon transport">
                            <a href="/page/Avtoperevozki">
                                <i></i>
                                <span class="h">Автоперевозки</span>
                                <span class="d">Автомобильные перевозки<br/>
                                в Екатеринбурге и области</span>
                            </a>
                        </li>

                        <li class="icon spec">
                            <a href="/page/Cpectehnika">
                                <i></i>
                                <span class="h">Спецтехника</span>
                                <span class="d">Продаем<br/> подержанную спецтехнику</span>
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
                        <a href="#tabs-1">
                            Легковые автомобили
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-2">
                            Грузовые автомобили
                        </a>    
                    </li>
                    <li>
                        <a href="#tabs-3">
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

                <div class="search-text">
                    <input type="text" value="" placeholder="Введите ваш запрос" />
                    <input type="submit" value="" />
                </div>

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
                                <input type="hidden" value="light" name="SearchFormOnMain[scenario]">
                                <?=$form->dropDownList($searchForm, 'brand', $Brands, array( 
                                                        'empty'=>'Выберите марку', 'class'=>'select','data-nested'=>'#model_1','data-model'=>'carBrands'));?>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Модель
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                        'empty'=>'Выберите модель', 'class'=>'select','id'=>'model_1'));?>
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
                    </div>

                    <div class="coll-2">
                        <dl>
                            <dt>
                                Тип кузова:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'bascet', $Bascet, array( 
                                        'empty'=>'Выберите марку', 'class'=>'select'));
                                ?>
                                
                            </dd>
                            <dt>
                                Состояние:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'state', $State, array( 
                                        'empty'=>'Состояние', 'class'=>'select'));
                                ?>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Тип КПП:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'transmission', UsedCarInfo::transmissionList(), array( 
                                        'empty'=>'Тип каробки передач', 'class'=>'select'));
                                ?>
                            </dd>
                            <dt>
                                Пробег:
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
                        
                    </div>
                    
                    <div class="coll-3">
                        <dl>
                            <dt>
                                Найдено<br/>
                                <span class="num">
                                    <?=$result['count']?> авто
                                </span>
                            </dt>
                            <dd>
                                <a href="/catalog" class="i-submit" >Показать</a>
                            </dd>
                        </dl>
                    </div>
                    <?php $this->endWidget(); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="parametr" id="tabs-2">

                <div class="search-text">
                    <input type="text" value="" placeholder="Введите ваш запрос" />
                    <input type="submit" value="" />
                </div>

                <div class="coll">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'search-form-weight',
                        'action' => $this->createUrl('/site/index'),
                        'htmlOptions' => array('class' => 'request_form')
                    )) ?>
                        <div class="coll-2">
                        
                        <dl>
                            <dt>
                                Марка
                            </dt>
                            <dd>
                                <input type="hidden" value="weight" name="SearchFormOnMain[scenario]">
                                <?=$form->dropDownList($searchForm, 'brand', $Brands, array( 
                                                        'empty'=>'Выберите марку', 'class'=>'select','data-nested'=>'#model_2','data-model'=>'carBrands'));?>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Модель
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                        'empty'=>'Выберите модель', 'class'=>'select','id'=>'model_2'));?>
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
                    </div>

                    <div class="coll-2">
                        <dl>
                            <dt>
                                Тип кузова:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'bascet', $Bascet, array( 
                                        'empty'=>'Выберите марку', 'class'=>'select'));
                                ?>
                                
                            </dd>
                            <dt>
                                Состояние:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'state', $State, array( 
                                        'empty'=>'Состояние', 'class'=>'select'));
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
                                <a href="/catalog" class="i-submit" >Показать</a>
                            </dd>
                        </dl>
                    </div>
                    <?php $this->endWidget(); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="parametr" id="tabs-3">

                <div class="search-text">
                    <input type="text" value="" placeholder="Введите ваш запрос" />
                    <input type="submit" value="" />
                </div>

                <div class="coll">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'search-form-weight',
                        'action' => $this->createUrl('/site/index'),
                        'htmlOptions' => array('class' => 'request_form')
                    )) ?>
                        <div class="coll-2">
                        
                        <dl>
                            <dt>
                                Тип
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'scenario', array('light'=>'Запчасти для легковых машин','weight'=>'Запчасти для грузовых машин'), array( 
                                                        'empty'=>'Выберите тип авто', 'class'=>'select','data-nested'=>'#model_3','data-model'=>'carBrands'));?>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Марка
                            </dt>
                            <dd>
                                
                                <?=$form->dropDownList($searchForm, 'brand', $Brands, array( 
                                                        'empty'=>'Выберите марку', 'class'=>'select','data-nested'=>'#model_3','data-model'=>'carBrands'));?>
                            </dd>
                        </dl>
                        <span></span>
                        <dl>
                            <dt>
                                Модель
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'car_model_id', array(), array( 
                                                        'empty'=>'Выберите модель', 'class'=>'select','id'=>'model_3'));?>
                            </dd>
                        </dl>
                        
                        <dl>
                            
                            <dt>
                                Раздел:
                            </dt>
                            <dd>
                                <?=$form->dropDownList($searchForm, 'category_id', CHtml::listData(Categories::model()->findAll('parent=0'),'id','name'), array( 
                                        'empty'=>'Разедл', 'class'=>'select'));
                                ?>
                            </dd>
                        </dl>
                        

                        <dl class="otdo">
                            
                        </dl>
                    </div>

                    <div class="coll-1">
                        
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
                                    42 авто
                                </span>
                            </dt>
                            <dd>
                                <a href="/detail/parts" class="i-submit" >Показать</a>
                            </dd>
                        </dl>
                    </div>
                    <?php $this->endWidget(); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="parametr" id="tabs-4">

                <div class="search-text">
                    <input type="text" value="" placeholder="Введите ваш запрос" />
                    <input type="submit" value="" />
                </div>

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
                                <a href="/detail/parts" class="i-submit" >Показать</a>
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
            <img class="loader" src="/media/images/loader.gif"/>
            <?=$this->renderPartial('//site/carCarusel',array('dataProvider'=>$dataProviderCar),true);?>
            <div class="clear"></div>
            <div class="readmore">
                <a href="/catalog" class="i-submit">Все Легковые автомобили</a>
            </div>
        </div>
        <!--cat auto End-->

        <!--page-->
        <div class="page new">
            <div class="wr">

                <div class="coll left">
                    <div class="tabs">
                        <ul>
                            <li >
                                <a href="#tabs-5">
                                    Новинки
                                </a>
                            </li>
                            <li class="active">
                                <a href="#tabs-6">
                                    Новости
                                </a>    
                            </li>
                        </ul>


                        <dl class="read">
                            <dt>
                                <a href="#">
                                    Подписаться на обновления
                                </a>
                            </dt>
                            <dt>
                                <a href="#">
                                    Все новости
                                </a>
                            </dt>
                        </dl>
                    </div>

                    <div class="content clear">
                        <div id="tabs-5" >
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('/site/newsCarusel',array('dataProvider'=>$dataProviderNews))?>
                        </div>
                        <div id="tabs-6" class="tab-active">
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('/site/newsCarusel',array('dataProvider'=>$dataProviderNews))?>
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
        <!--page End-->

        <!--about-->
        <div class="about">
            <h1>
                О компании
            </h1>
            <p>
                Добро пожаловать в интернет-магазин компании «Разбор66». Мы предлагаем самый  широкий ассортимент авторазбора  в Екатеринбурге на любые марки автомобилей по адекватным ценам. Покупая и запчасти в нашем Интернет-магазине, вы можете быть уверены в качестве — ведь мы работаем только с крупными
и проверенными производителями.
            </p>
            <p>         
                Благодаря широкой партнерской сети наш каталог постоянно пополняется иномарками европейского, японского и китайского производства.Если вы нигде не можете найти необходимую деталь — оставьте заявку на индивидуальный подбор, мы найдем авторазборку в самые короткие сроки.
            </p>
            <div class="readmore">
                <a href="#" class="i-submit">
                    Узнать о сотрудничестве
                </a>
            </div>
        </div>
        <!--about End-->
        
        <!--plus-->
        <div class="plus">
            <ul class="list">
                <li class="park">
                    <i></i>
                    Самый большой парк<br/>
                    битых авто в Екатеринбурге
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
    </div>