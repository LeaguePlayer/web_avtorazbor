
<div class="page">
            <h1 class="head">
                Каталог
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                        <dl>
                            <dt>
                                Страна:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('country','id', $Countries,array('empty'=>'Выберите страну','class'=>'select nested','data-nested'=>'carBrands','id'=>'country'))?>
                            </dd>
                            <dt>
                                Марка:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('carBrands','id', $Brands,array('empty'=>'Выберите марку','class'=>'select','id'=>'carBrands'))?>
                            </dd>
                            <dt>
                                Цена (руб):
                            </dt>
                            <dd id="slider">
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minCost" value="0"/>
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text"><input type="text" id="maxCost" value="1000"/>
                                </div>
                                </div>
                                <div class="sliderCont">
                                        <div id="slider"></div>
                                </div>

                                <div class="calculate">
                                    <div class="line" data-min="#minCost" data-max="#maxCost">
                                    </div>
                                    <ul>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                        </li>
                                    </ul>
                                </div>

                            </dd>
                            <dt id="bascet-label">
                                Тип кузова:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('bascet','id', $Bascet,array('empty'=>'Выберите тип кузова','class'=>'select'))?>
                            </dd>
                            <dt id="transmission-label">
                                Тип КПП:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('transmission','id', $Transmission,array('empty'=>'Выберите тип кпп','class'=>'select'))?>
                            </dd>
                            <dt>
                                Мощность (л.с.):
                            </dt>
                            <dd id="slider2">
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minForce" value="0"/>
                                    </div>
                                    <label for="maxforce">-</label> <div class="i-text"><input type="text" id="maxForce" value="300"/>
                                    </div>
                                </div>
                                <div class="sliderCont">
                                    <div id="slider2"></div>
                                </div>
                                <div class="line-2" data-min="#minForce" data-max="#maxForce">
                                    </div>
                            </dd>

                            <dd class="submit">
                                <input type="submit" class="i-submit" value="Сбросить" />
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
                                            <li>
                                                <a href="/catalog?sort=city" data-sort="city">
                                                    Городу
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?sort=mileage" data-sort="mileage">
                                                    Пробегу
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?sort=brand" data-sort="carBrands">
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

                                <div class="num">
                                    Всего результатов - 41, показано с 1 по 20
                                </div>

                                <dl class="coll"> 
                                    <dt>
                                        Показывать по:
                                    </dt>
                                    <dd>
                                        <ul id="display">
                                            <li class="active">
                                                <a href="/catalog?display=1">
                                                    1
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=2">
                                                    2
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=3">
                                                    3
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