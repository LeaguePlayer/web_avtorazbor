
<div class="page">
            <h1 class="head">
                Каталог автозапчастей
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                        <dl>
                            <dt>
                                Страна:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('country','id', $Countries,
                                            array('empty'=>'Выберите страну','class'=>'select nested','data-nested'=>'#carBrands', 'data-column'=>'id_country', 'id'=>'country',))?>
                            </dd>
                            <dt>
                                Марка:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('carBrands', 'id', $Brands, array( 'options' => array($Brands_id=>array('selected'=>true)), 
                                                        'empty'=>'Выберите марку', 'class'=>'select nested','data-nested'=>'#carModels','data-column'=>'brand', 'id'=>'carBrands'))?>
                            </dd> 
                            <dt id="bascet-label">
                                Модель автомобиля:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('carModels','id', $Models, array( 'options' => array($Model_id=>array('selected'=>true)),'empty'=>'Выберите модель','class'=>'select'))?>
                            </dd>
                            <dt> 
                               Асб Раздел:
                            </dt>
                            <dd>
                                        <?=CHtml::dropDownList('Categories','id', $Categories,
                                            array(
                                                'options' => array($Category_id=>array('selected'=>true)),
                                                'empty'=>'Выберите раздел',
                                                'class'=>'select',
                                                'id'=>'Categories',
                                                'ajax' => array(
                                                'type'=>'GET', //request type
                                                'dataType'=>'json',
                                                'url'=>CController::createUrl('/ajaxRequests/getSubCategories'), //url to call.
                                                //Style: CController::createUrl('currentController/methodToCall')
                                                'update'=>'#subCategoies', //selector to update
                                                'data'=>array('value'=>'js:this.value','model'=>'subCategories'),
                                                'success'=>'function(data){

                                                    $_parent=$("#subCategories").closest("dd");
                                                    $_parent.empty().html(data);
                                                    $("select",$_parent).selectbox();
                                                    $("select").on("change",function(){
                                                        changeView();
                                                    })
                                                }'
                                                //leave out the data key to pass all form values through
                                                ))); 
                                                //empty since it will be filled by the other dropdown
                                        ?>
                            </dd>
                            <dt> 
                                Под раздел:
                            </dt>
                            <dd>
                                <?=CHtml::dropDownList('subCategories','id', $subCategories, array('options' => array($subCategory_id=>array('selected'=>true)),'empty'=>'Выберите под категорию'))?>
                            </dd>
                            <dt>
                                Цена (руб):
                            </dt>
                            <dd id="slider">
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
                                <a href="/detail/parts" class="i-submit" >Сбросить</a>
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