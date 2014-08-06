<div class="page">
            <h1 class="head">
                Каталог автозапчастей и дисков
            </h1>

            <div class="wr">

                <div class="coll left">

                    <div class="partsTabs">
                        <ul>
                            <li <?= $_GET['light'] || !$_GET ? 'class="active"' : '' ?>>
                                <a href="#light">
                                    Для легковых
                                </a>
                            </li>
                            <li <?= $_GET['hard'] ? 'class="active"' : '' ?>>
                                <a href="#weight">
                                    Для грузовых
                                </a>    
                            </li>
                            <li <?= $_GET['disc'] ? 'class="active"' : '' ?>>
                                <a href="#disc">
                                    Диски
                                </a>    
                            </li>
                            <li>
                                <a href="#book">
                                    Заказать деталь
                                </a>    
                            </li>
                        </ul>
                    </div>

                    <div class="content clear">

                        <div class="personal <?=$_GET['light'] || $_GET['hard'] || !$_GET ? 'tab-active' : '' ?>" id="light">
                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>
                            <form class="criteria" action="/detail/parts" method="get">
                                <div class="select">
                                    <dl>
                                    <dd>
                                        <input type="hidden" id="car_type" name="car_type" value="<?=$_GET['light'] || $_GET['disc'] || !$_GET ? 1 : 2 ?>">
                                        <label for="mark"> 
                                            Марка:
                                        </label>
                                        
                                        <?=CHtml::dropDownList('carBrands','', $Brand,
                                            array(
                                                'empty'=>'Выберите марку ',
                                                'class'=>'select',
                                                'id'=>'carBrands',
                                                'data-nested'=>'#carModels'
                                            )
                                        ); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model"> 
                                            Марка:
                                        </label>
                                        <?=CHtml::dropDownList('carModels','id', array())?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model"> 
                                            Раздел:
                                        </label>
                                        <?=CHtml::dropDownList('Categories','id', CHtml::listData(Categories::model()->findAll('parent=0'),'id','name'),
                                        array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-nested'=>'#subCategories'
                                            )
                                        ); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model">
                                            Под категория:
                                        </label>
                                        <?=CHtml::dropDownList('subCategories','id', array())?>
                                    </dd>
                                    <br>
                                    <input type="submit" class="i-submit" id="sendCriteria" value="Найти">
                                    </dl>
                                </div>
                            </form>
                        </div>
                        
                        <div id="disc" class=" <?= $_GET['disc'] ? 'tab-active' : '' ?>">
                            <form action="/detail/disc" method="get">
                                <div class="formCost">
                                    <dl class="desc">
                                        <dt>
                                            Индивидуальный подбор
                                        </dt>
                                        <dd>
                                            Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                        </dd>
                                        <dd>
                                            Диаметр дисков (в дюймах).
                                        </dd>
                                    </dl>
                                    <input type="hidden" name="disc" />
                                    <div class="i-text">
                                        <input type="text" id="minSize" name="min" value="14">
                                    </div>
                                    <label for="maxforce">-</label> 
                                    <div class="i-text">
                                        <input type="text" id="maxSize" name="max" value="25">
                                    </div>
                                </div>
                            
                            <div class="sliderCont">
                                <div id="slider2"></div>
                            </div>
                            <div class="line"></div>
                                <input type="submit" class="i-submit" value="Найти"/>
                            </form>
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
<?=$this->renderPartial('//forms/bookPart',array('model'=>new Bookpart));?>
