
<div class="page detail-top">
            

            <div class="wr">
                <div class="coll-left">
                    <div class="modul filter">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'parts-form',
                'action' => $this->createUrl('/detail/parts'),
                'htmlOptions' => array('class' => 'request_form')
            )) ?>
                <?=$form->hiddenField($searchForm,'type')?>
                <?=$form->hiddenField($searchForm,'sort')?>
                <?=$form->hiddenField($searchForm,'display')?>
                <?=$form->hiddenField($searchForm,'scenario',array('value'=>'parts'))?>
                        <dl>
                            <dd>
                                <label>Страна:</label>
                                <?=$form->dropDownList($searchForm,'id_country', $Countries,
                                            array('empty'=>'Выберите страну',
                                                'class'=>'select nested',
                                                'data-nested'=>'#carBrands',
                                                'data-model'=>'country', 
                                                'id'=>'country',
                                                )
                                            )?>
                            </dd>

                            <dd style="display:<?=($Brands ? 'block' : 'none')?>">
                                <label>Марка:</label>
                                <?=$form->dropDownList($searchForm,'brand', $Brands, 
                                        array(
                                            'empty'=>'Выберите марку ',
                                            'class'=>'select',
                                            'id'=>'carBrands',
                                            'data-nested'=>'#carModels',
                                            'data-model'=>'carBrands'
                                            )
                                        )?>
                            </dd> 
                            <dd style="display:<?=$Models ? 'block' : ''?>">
                                <label>Модель автомобиля:</label>
                                <?=$form->dropDownList($searchForm,'car_model_id', $Models, 
                                array( 
                                    'empty'=>'Выберите раздел',
                                    'class'=>'select',
                                    'id'=>'carModels',
                                    'data-nested'=>'#Categories',
                                    'data-model'=>'carModels'
                                    )
                                )?>
                            </dd>

                            <dd style="display:<?=($Categories ? 'block' : 'none')?>">
                                <label>Раздел:</label>
                                <?=$form->dropDownList($searchForm, 'parent', $Categories,
                                    array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-nested'=>'#subCategories',
                                            'data-model'=>'Categories'
                                        )
                                    );
                                ?>
                            </dd>
                            
                            <dd style="display:<?=($subCategories ? 'block' : 'none')?>">
                                <label>Подраздел:</label>
                                <?=$form->dropDownList($searchForm,'category_id', $subCategories, 
                                array('empty'=>'Выберите под категорию','id'=>'subCategories'))?>
                            </dd>
                            
                            <dd>
                                <label>Цена (руб):</label>
                            </dd>
                            <dd id="slider">
                                <div class="formCost">
                                    <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st',array('id'=>'minCost','value'=>'10'))?>
                                    <!-- <input type="text" id="minCost" value="10"/> -->
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                <?=$form->textField($searchForm,'price_end',array('id'=>'maxCost','value'=>'10000'))?>
                                <!-- <input type="text" id="maxCost" value="10000"/> -->
                                </div>
                                </div>

                                <div class="calculate">
                                    <div class="partPrice" data-min="#minCost" data-max="#maxCost">
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
                                    </ul>
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
                            <li <?=$searchForm->type=='1' ? 'class="active"' : '' ?>>
                                <a href="#" data-scenario="1">
                                    Легковые
                                </a>
                            </li>
                            <?
                                if ($WeightBrandsExists)
                                {
                            ?>
                            <li <?=$searchForm->type=='2' ? 'class="active"' : '' ?>>
                                <a href="/detail?Search[scenario]=weight" data-scenario="2">
                                    Грузовые
                                </a>    
                            </li>
                            <?}?>
                            <li>
                                <a href="/detail?Search[scenario]=disc" data-scenario="disc">
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
                                            <li data-sort="category_id">
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