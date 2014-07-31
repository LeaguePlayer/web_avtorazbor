
<div class="page">
            <h1 class="head">
                Каталог автозапчастей
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                        <dl>
                            
                            <dt>
                                Диаметр (дюймы):
                            </dt>
                            <dd id="slider">
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minSize" value="14"/>
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                <input type="text" id="maxSize" value="30"/>
                                </div>
                                </div>

                                <div class="calculate">
                                    <div class="partPrice" data-min="#minCost" data-max="#maxCost">
                                    </div>
                                </div>
                            </dd>

                            <dt>
                                Цена (руб):
                            </dt>
                            <dd id="slider-2">
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minCost" value="100"/>
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                <input type="text" id="maxCost" value="500000"/>
                                </div>
                                </div>

                                <div class="calculate">
                                    <div class="partPrice" data-min="#minCost" data-max="#maxCost">
                                    </div>
                                </div>
                            </dd>
                            
                            <dd class="submit">
                                <a href="/catalog" class="i-submit" >Сбросить</a>
                            </dd>
                        </dl>   
                    </div>
                </div>

                <div class="coll-right">
                    <div class="tabs parts">
                        <ul id="car_type">
                            <li <?=$_GET['car_type']==1 ? 'class="active"' : '' ?>>
                                <a href="#" data-type="1">
                                    Легковые
                                </a>
                            </li>
                            <li <?=$_GET['car_type']==2 ? 'class="active"' : '' ?>>
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
                                            <li class="active" data-sort="price_buy">
                                                <a href="/detail/parts?sort=price_buy">
                                                    Цене
                                                </a>
                                            </li>
                                            <li data-sort="name">
                                                <a href="/detail/parts?sort=year" >
                                                    Названию
                                                </a>
                                            </li>
                                            <li data-sort="brand">
                                                <a href="/detail/parts?sort=category" >
                                                    Разделу
                                                </a>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>

                            <div class="auto">
                                <?=$this->renderPartial('tabParts',array('dataProvider'=>$dataProvider));?>
                            </div>

                            <div class="result">

                                <dl class="coll"> 
                                    <dt>
                                        Показывать по:
                                    </dt>
                                    <dd>
                                        <ul id="display">
                                            <li class="active">
                                                <a href="/detail/ajaxUpdate?display=20">
                                                    20
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/detail/ajaxUpdate?display=40">
                                                    40
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/detail/ajaxUpdate?display=60">
                                                    60
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