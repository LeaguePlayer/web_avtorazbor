
<div class="page">
            <h1 class="head">
                Каталог автозапчастей
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                    <form id="criteria-form">
                        <dl>
                            
                            <dd>
                                <label>Страна:</label>
                                <?=CHtml::dropDownList('country','id', $Countries,
                                            array('options' => array($country_id=>array('selected'=>true)), 'empty'=>'Выберите страну','class'=>'select nested','data-nested'=>'#carBrands', 'id'=>'country',))?>
                            </dd>
                            
                            <dd style="<?=$Brands_id || $country_id ? 'display:block' : 'display:none' ?>">
                                <label>Марка:</label>
                                <?=CHtml::dropDownList('carBrands', 'id', $Brands, array( 'options' => array($Brands_id=>array('selected'=>true)), 
                                                        'empty'=>'Выберите марку', 'class'=>'select nested','data-nested'=>'#carModels', 'id'=>'carBrands'))?>
                            </dd> 
                            <dd style="<?=$Model_id || $Brands_id ? 'display:block' : 'display:none' ?>">
                                <label>Модель автомобиля:</label>
                                <?=CHtml::dropDownList('carModels','id', $Models, array( 'options' => array($Model_id=>array('selected'=>true)),'empty'=>'Выберите модель','class'=>'select'))?>
                            </dd>
                            
                            <dd style="<?=$Category_id || $Model_id ? 'display:block' : 'display:none' ?>">
                                <label>Раздел:</label>
                                <?=CHtml::dropDownList('Categories','id', $Categories,
                                    array(
                                        'options' => array($Category_id=>array('selected'=>true)),
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-nested'=>'#subCategories'
                                        )
                                    );
                                ?>
                            </dd>
                            
                            <dd style="<?=$subCategory_id || $Category_id ? 'display:block' : 'display:none' ?>">
                                <label>Подраздел:</label>
                                <?=CHtml::dropDownList('subCategories','id', $subCategories, array('options' => array($subCategory_id=>array('selected'=>true)),'empty'=>'Выберите под категорию'))?>
                            </dd>
                            
                            <dt>
                                Цена (руб):
                            </dt>
                            <dd id="slider">
                                <div class="formCost">
                                    <div class="i-text">
                                    <input type="text" id="minCost" value="10"/>
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                <input type="text" id="maxCost" value="10000"/>
                                </div>
                                </div>

                                <div class="calculate">
                                    <div class="partPrice" data-min="#minCost" data-max="#maxCost">
                                    </div>
                                </div>
                            </dd>
                            
                            <dd class="submit">
                                <a href="/detail/parts" class="i-submit" >Сбросить</a>
                            </dd>
                        </dl> 
                        </form>  
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
                            <li>
                                <a href="/detail?disc=1" data-type="2">
                                    Диски
                                </a>    
                            </li>
                        </ul>
                    </div>
                    <div class="content clear">

                        <div class="catalog">
                            <img class="loader" src="/media/images/loader.gif"/>
                            <div class="pag">

                                <ul>
                                    <li class="active">
                                        <a href="#">
                                            Все(<?=$dataProvider->totalItemCount?>)
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