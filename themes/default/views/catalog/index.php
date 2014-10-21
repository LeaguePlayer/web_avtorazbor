
<div class="page detail-top">
            

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter" id="light" style="display:<?=$searchForm->scenario=='light' ? 'block' : 'none'?>">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'parts-form',
                                'action' => $this->createUrl('/catalog'),
                                'method'=>'get',
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                            <?=$form->hiddenField($searchForm,'display')?>
                            <?=$form->hiddenField($searchForm,'scenario',array('value'=>'light'))?>
                            <?=$form->hiddenField($searchForm,'sort')?>
                        <dl>
                            <dd>
                                
                                <label>Страна:</label>
                                <?=$form->dropDownList($searchForm,'id_country', $Countries,
                                            array('empty'=>'Выберите страну','class'=>'select nested','data-model'=>'country', 'data-nested'=>'#brand', 'id'=>'country'))?>
                                            
                            </dd>
                            <dd style="display:<?=$searchForm->id_country ? 'block' : 'none'?>">
                            <label> Марка:</label>
                                <?=$form->dropDownList($searchForm,'brand', $Brands, array( 'options' => array($Brands_id=>array('selected'=>true)), 
                                                        'empty'=>'Выберите марку', 'class'=>'select nested','data-model'=>'carBrands','data-nested'=>'#model','data-column'=>'brand', 'id'=>'brand'))?>
                            </dd>
                            <dd style="display:<?=$searchForm->brand ? 'block' : 'none'?>">
                                <label>Модель автомобиля:</label>
                                <?=$form->dropDownList($searchForm,'car_model_id', $Models, array( 'options' => array($Model_id=>array('selected'=>true)),'empty'=>'Выберите модель','class'=>'select','id'=>'model'))?>
                            </dd>
                            <dd id="slider">
                                <label> Цена (руб):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st',array('id'=>'minCost'))?>
                                </div>
                                    <label for="maxCost">-</label> 
                                    <div class="i-text">
                                        <?=$form->textField($searchForm,'price_end',array('id'=>'maxCost'))?>
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
                                <?=$form->dropDownList($searchForm,'bascet', $Bascet,array('empty'=>'Выберите тип кузова','class'=>'select'))?>
                            </dd>
                            <dd>
                                <label>Тип КПП:</label>
                                <?=$form->dropDownList($searchForm,'transmission', $Transmission,array('empty'=>'Выберите тип кпп','class'=>'select'))?>
                            </dd>
                            
                            <dd id="slider2">
                                <label>Мощность (л.с.):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                        <?=$form->textField($searchForm,'force_st',array('id'=>'minForce'))?>
                                    <!-- <input type="text" id="minForce" value="0"/> -->
                                    </div>
                                    <label for="maxforce">-</label> <div class="i-text">
                                    <?=$form->textField($searchForm,'force_end',array('id'=>'maxForce'))?>
                                    <!-- <input type="text" id="maxForce" value="1000"/> -->
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
                        <?$this->endWidget();?>  
                    </div>
                    <div class="modul filter" id="weight" style="display:<?=$searchForm->scenario=='weight' ? 'block' : 'none'?>">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'parts-form',
                                'action' => $this->createUrl('/catalog'),
                                'method'=>'get',
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                            <?=$form->hiddenField($searchForm,'display')?>
                            <?=$form->hiddenField($searchForm,'scenario',array('value'=>'weight'))?>
                            <?=$form->hiddenField($searchForm,'type',array('value'=>'1'))?>
                            <?=$form->hiddenField($searchForm,'sort')?>
                        <dl>
                            <dd>
                                
                                <label>Страна:</label>
                                <?=$form->dropDownList($searchForm,'id_country', $Countries,
                                            array('empty'=>'Выберите страну','class'=>'select nested','data-model'=>'country', 'data-nested'=>'#brand', 'id'=>'country'))?>
                                            
                            </dd>
                            <dd style="display:<?=$searchForm->id_country ? 'block' : 'none'?>">
                            <label> Марка:</label>
                                <?=$form->dropDownList($searchForm,'brand', $Brands, array( 'options' => array($Brands_id=>array('selected'=>true)), 
                                                        'empty'=>'Выберите марку', 'class'=>'select nested','data-model'=>'carBrands','data-nested'=>'#model','data-column'=>'brand', 'id'=>'brand'))?>
                            </dd>
                            <dd style="display:<?=$searchForm->brand ? 'block' : 'none'?>">
                                <label>Модель автомобиля:</label>
                                <?=$form->dropDownList($searchForm,'car_model_id', $Models, array( 'options' => array($Model_id=>array('selected'=>true)),'empty'=>'Выберите модель','class'=>'select','id'=>'model'))?>
                            </dd>
                            <dd id="slider">
                                <label> Цена (руб):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                    <?=$form->textField($searchForm,'price_st',array('id'=>'minCost'))?>
                                </div>
                                    <label for="maxCost">-</label> 
                                    <div class="i-text">
                                        <?=$form->textField($searchForm,'price_end',array('id'=>'maxCost'))?>
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
                                <?=$form->dropDownList($searchForm,'bascet', $Bascet,array('empty'=>'Выберите тип кузова','class'=>'select'))?>
                            </dd>
                            <dd>
                                <label>Тип КПП:</label>
                                <?=$form->dropDownList($searchForm,'transmission', $Transmission,array('empty'=>'Выберите тип кпп','class'=>'select'))?>
                            </dd>
                            
                            <dd id="slider2">
                                <label>Мощность (л.с.):</label>
                                <div class="formCost">
                                    <div class="i-text">
                                        <?=$form->textField($searchForm,'force_st',array('id'=>'minForce'))?>
                                    <!-- <input type="text" id="minForce" value="0"/> -->
                                    </div>
                                    <label for="maxforce">-</label> <div class="i-text">
                                    <?=$form->textField($searchForm,'force_end',array('id'=>'maxForce'))?>
                                    <!-- <input type="text" id="maxForce" value="1000"/> -->
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
                        <?$this->endWidget();?>  
                    </div>
                </div>

                <div class="coll-right">
                    <div class="tabs">
                        <ul id="car_type">
                            <li class="<?=$searchForm->scenario=="light" ? 'active' : '' ?>">
                                <a href="#" data-type="1">
                                    Легковые
                                </a>
                            </li>
                            <?
                                if (!empty($WeightBrands))
                                {
                            ?>
                            <li class="<?=$searchForm->scenario=="weight" ? 'active' : '' ?>">
                                <a href="#" data-type="2">
                                    Грузовые
                                </a>    
                            </li>
                            <?}?>
                        </ul>
                        <h1 class="head">
                            Каталог авто
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
                                    <li>    
                                    </li>
                                    <li>
                                        <a class="news" href="#">
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
                                                <a href="/catalog?display=20">
                                                    20
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=40">
                                                    40
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/catalog?display=60">
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