
<div class="page detail-top">
            

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'parts-form',
                'action' => $this->createUrl('/detail/parts'),
                'htmlOptions' => array('class' => 'request_form')
            )) ?>
                <?=$form->hiddenField($searchForm,'type',array('value'=>2))?>
                <?=$form->hiddenField($searchForm,'sort')?>
                <?=$form->hiddenField($searchForm,'display')?>
                <?=$form->hiddenField($searchForm,'scenario')?>

                        <dl>
                            <dd>
                                <label>Страна:</label>
                                <?=$form->dropDownList($searchForm,'id_country', $Countries,
                                            array('empty'=>'Выберите страну','class'=>'select nested','data-nested'=>'#brand','data-model'=>'country', 'id'=>'country',))?>
                            </dd>
                            <dd style="display:<?=($searchForm->brand ? 'block' : 'none')?>">
                                <label>Марка:</label>
                                <?=$form->dropDownList($searchForm,'brand', $Brands, 
                                        array(
                                            'empty'=>'Выберите марку', 'class'=>'select nested','data-nested'=>'#car_model_id', 'id'=>'brand', 'data-model'=>'carBrands',))?>
                            </dd> 
                            <dd>
                                <label>Модель автомобиля:</label>
                                <?=$form->dropDownList($searchForm,'car_model_id', $Models, array( 'empty'=>'Выберите модель','class'=>'select','id'=>'car_model_id'))?>
                            </dd>
                            <dd style="display:<?=($searchForm->category_id ? 'block' : 'none')?>">
                                <label>Раздел:</label>
                                <?=$form->dropDownList($searchForm, 'category_id', $Categories,
                                    array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-model'=>'Categories',
                                            'data-nested'=>'#subCategories'
                                        )
                                    );
                                ?>
                            </dd>
                            <dd style="display:<?=($searchForm->parent ? 'block' : 'none')?>">
                                <label>Подраздел:</label>
                                <?=$form->dropDownList($searchForm,'parent', $subCategories, array('empty'=>'Выберите под категорию','id'=>'subCategories'))?>
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
                        <?php $this->endWidget(); ?>
                    </div>
                </div>

                <div class="coll-right">
                    <div class="tabs parts">
                        <ul id="car_type">
                            <li <?=$searchForm->scenario=='light' ? 'class="active"' : '' ?>>
                                <a href="#" data-scenario="light">
                                    Легковые
                                </a>
                            </li>
                            <li <?=$searchForm->scenario=='weight' ? 'class="active"' : '' ?>>
                                <a href="#" data-scenario="weight">
                                    Грузовые
                                </a>    
                            </li>
                            <li>
                                <a href="/detail?SearchFormOnMain[scenario]=disc" data-scenario="disc">
                                    Диски
                                </a>    
                            </li>
                        </ul>
                        <h1 class="head">
                            Каталог автозапчастей
                        </h1>
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
                                </ul>

                                <dl>
                                    <dt>
                                        Сортировать по:
                                    </dt>
                                    <dd>
                                        <ul id="sort">
                                            <li class="active" data-sort="price_sell">
                                                <a href="/detail/parts?sort=price_sell">
                                                    Цене
                                                </a>
                                            </li>
                                            <li data-sort="name">
                                                <a href="/detail/parts?sort=name" >
                                                    Названию
                                                </a>
                                            </li>
                                            <li data-sort="brand">
                                                <a href="/detail/parts?sort=brand" >
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