
<div class="page">
            <h1 class="head">
                Каталог
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                        <dl>
                            <dd>
                                <label>Страна:</label>
                                <?=CHtml::dropDownList('country','id', $Countries,
                                            array('empty'=>'Выберите страну','class'=>'select nested','data-nested'=>'#carBrands', 'data-column'=>'id_country', 'id'=>'country','style'=>'display'))?>
                            </dd>
                            <dd>
                            <label> Марка:</label>
                                <?=CHtml::dropDownList('carBrands', 'id', $Brands, array( 'options' => array($Brands_id=>array('selected'=>true)), 
                                                        'empty'=>'Выберите марку', 'class'=>'select nested','data-nested'=>'#carModels','data-column'=>'brand', 'id'=>'carBrands'))?>
                            </dd>
                            <dd>
                                <label>Модель автомобиля:</label>
                                <?=CHtml::dropDownList('carModels','id', $Models, array( 'options' => array($Model_id=>array('selected'=>true)),'empty'=>'Выберите модель','class'=>'select'))?>
                            </dd>
                            <dd id="slider">
                                <label> Цена (руб):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minCost" value="1000"/>
                                </div>
                                    <label for="maxCost">-</label> 
                                    <div class="i-text">
                                        <input type="text" id="maxCost" value="3000000"/>
                                    </div>
                                </div>
                                <div class="sliderCont">
                                    <div id="slider"></div>
                                </div>
                                <div class="calculate">
                                    <div class="line" data-min="#minCost" data-max="#maxCost">
                                    </div>
                                </div>
                            </dd>
                            <dd>
                                <label>Тип кузова:</label>
                                <?=CHtml::dropDownList('bascet','id', $Bascet,array('empty'=>'Выберите тип кузова','class'=>'select'))?>
                            </dd>
                            <dd>
                                <label>Тип КПП:</label>
                                <?=CHtml::dropDownList('transmission','id', $Transmission,array('empty'=>'Выберите тип кпп','class'=>'select'))?>
                            </dd>
                            
                            <dd id="slider2">
                                <label>Мощность (л.с.):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minForce" value="0"/>
                                    </div>
                                    <label for="maxforce">-</label> <div class="i-text"><input type="text" id="maxForce" value="1000"/>
                                    </div>
                                </div>
                                <div class="sliderCont">
                                    <div id="slider2"></div>
                                </div>
                                <div class="line-2" data-min="#minForce" data-max="#maxForce">
                                    </div>
                            </dd>

                            <dd class="submit">
                                <a href="/catalog" class="i-submit" >Сбросить</a>
                            </dd>
                        </dl>   
                    </div>
                </div>

                <div class="coll-right">
                    <div class="tabs">
                        <ul id="car_type">
                            <li class="active">
                                <a href="#" data-type="1">
                                    Легковые
                                </a>
                            </li>
                            <li>
                                <a href="#" data-type="2">
                                    Грузовые
                                </a>    
                            </li>
                        </ul>
                    </div>
                    <div class="content clear">

                        <div class="catalog">

                            <div class="pag">

                                <ul>
                                    <li class="active">
                                        <a href="#">
                                            Все(41)
                                        </a>
                                    </li>
                                    <li>    
                                        <a href="#">
                                            Акции
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Новинки
                                        </a>    
                                    </li>
                                </ul>

                                <dl>
                                    <dt>
                                        Сортировать по:
                                    </dt>
                                    <dd>
                                        <ul id="sort">
                                            <li class="active" data-sort="price">
                                                <a href="/catalog?sort=price">
                                                    Цене
                                                </a>
                                            </li>
                                            <li data-sort="year">
                                                <a href="/catalog?sort=year" >
                                                    Год
                                                </a>
                                            </li>
                                            <li data-sort="mileage">
                                                <a href="/catalog?sort=mileage" >
                                                    Пробегу
                                                </a>
                                            </li>
                                            <li data-sort="brand">
                                                <a href="/catalog?sort=brand" >
                                                    Марке
                                                </a>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>

                            <div class="auto">
                                <?
                                    $this->renderPartial('tabView',array('dataProvider'=>$dataProvider),false,false);
                                ?>
                            </div>

                            <div class="result">

                                <dl class="coll"> 
                                    <dt>
                                        Показывать по:
                                    </dt>
                                    <dd>
                                        <ul id="display">
                                            <li class="active">
                                                <a href="/catalog?display=2">
                                                    2
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=3">
                                                    3
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=4">
                                                    4
                                                </a>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>

                            </div>
                        </div>

                        <div class="clear"></div>

                    </div>
                </div>


                <div class="clear"></div>
            </div>
        </div>  