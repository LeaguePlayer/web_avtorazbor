<div class="page">
            <h1 class="head">
                Каталог автозапчастей и дисков
            </h1>

            <div class="wr">

                <div class="coll left">

                    <div class="partsTabs">
                        <ul>
                            <li <?=$searchForm->scenario=='light' ? 'class="active"' : '' ?>>
                                <a href="#light">
                                    Для легковых
                                </a>
                            </li>
                            <?
                                if ($WeightBrand){
                            ?>
                            <li <?= $searchForm->scenario=='weight' ? 'class="active"' : '' ?>>
                                <a href="#weight">
                                    Для грузовых
                                </a>
                            </li>
                            <?}?>
                            <li <?=$searchForm->scenario=='disc' ? 'class="active"' : '' ?>>
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
                        <div class="personal <?=$searchForm->scenario=='light' ? 'tab-active' : '' ?>" id="light">
                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'parts-form',
                                'action' => $this->createUrl('/detail/parts'),
                                'method'=>'get',
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                                <div class="select">
                                    <dl>
                                    <dd>
                                        <?=$form->hiddenField($searchForm,'type',array('value'=>1))?>

                                        <?=$form->hiddenField($searchForm,'scenario',array('value'=>'parts'))?>

                                        <label for="mark"> 
                                            Марка:
                                        </label>
                                        
                                        <?=$form->dropDownList($searchForm,'brand', $Brand,
                                            array(
                                                'empty'=>'Выберите марку ',
                                                'class'=>'select',
                                                'id'=>'carBrands',
                                                'data-nested'=>'#carModels',
                                                'data-model'=>'carBrands',
                                                'data-enabled'=>true,
                                            )
                                        ); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </dd>
                                    <dd style="display:<?=$searchForm->car_model_id ? 'block' : 'none'?>;">
                                        <label for="model"> 
                                            Модель:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'car_model_id', $Models, array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'carModels',
                                            'data-nested'=>'#Categories',
                                            'data-model'=>'carModels'
                                            ))?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model"> 
                                            Раздел:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'parent', CHtml::listData(Categories::model()->findAll('parent=0'),'id','name'),
                                        array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-nested'=>'#subCategories',
                                            'data-model'=>'categories'
                                            )
                                        );
                                        ?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model">
                                            Под категория:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'category_id', array(),array('id'=>'subCategories'))?>
                                    </dd>
                                    <dt>
                                        <input type="submit" class="i-submit" width="100%" id="sendCriteria" value="Найти">
                                    </dt>
                                    </dl>
                                    <?$this->endWidget()?>
                                </div>
                            
                        </div>

                        <?if (count($WeightBrand)){?>

                        <div class="personal <?=$searchForm->scenario=='weight' ? 'tab-active' : '' ?>" id="weight">
                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'parts-form',
                                'action' => $this->createUrl('/detail/parts'),
                                'method'=>'get',
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                                <div class="select">
                                    <dl>
                                    <dd>

                                        <?=$form->hiddenField($searchForm,'type',array('value'=>2,))?>

                                        <?=$form->hiddenField($searchForm,'scenario',array('value'=>'parts'))?>

                                        <label for="mark"> 
                                            Марка:
                                        </label>
                                        
                                        <?=$form->dropDownList($searchForm,'brand', $WeightBrand,
                                            array(
                                                'empty'=>'Выберите марку ',
                                                'class'=>'select',
                                                'id'=>'carBrands',
                                                'data-nested'=>'#carModels',
                                                'data-model'=>'carBrands'
                                            )
                                        ); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model"> 
                                            Модель:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'car_model_id', array(), array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'carModels',
                                            'data-nested'=>'#Categories',
                                            'data-model'=>'carModels'
                                            ))?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model"> 
                                            Раздел:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'parent', CHtml::listData(Categories::model()->findAll('parent=0'),'id','name'),
                                        array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'data-nested'=>'#subCategories',
                                            'data-model'=>'categories'
                                            )
                                        );
                                        ?>
                                    </dd>
                                    <dd style="display:none;">
                                        <label for="model">
                                            Под категория:
                                        </label>
                                        <?=$form->dropDownList($searchForm,'category_id', array(),array('id'=>'subCategories'))?>
                                    </dd>
                                    <dt>
                                        <input type="submit" class="i-submit" width="100%" id="sendCriteria" value="Найти">
                                    </dt>
                                    </dl>
                                    <?$this->endWidget()?>
                                </div>
                            
                        </div>

                        <?}?>
                        <div id="disc" class="personal <?=$searchForm->scenario=='disc' ? 'tab-active' : '' ?>">
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
                                    <dl>
                                        <dd>
                                            <input type="hidden" name="Search[category_id]" value="295"/>
                                            <input type="hidden" name="Search[scenario]" value="disc"/>
                                            <?=$form->hiddenField($searchForm,'type',array('value'=>1))?>
                                            <div class="i-text">
                                                <?=$form->textField($searchForm,'diametr_st',array('id'=>'minSize','value'=>14))?>
                                            </div>
                                            <label for="maxforce">-</label> 
                                            <div class="i-text">
                                                <!-- <input type="text" id="maxSize" name="max" value="25"> -->
                                                <?=$form->textField($searchForm,'diametr_end',array('id'=>'maxSize','value'=>25))?>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            <div class="calculate">
                                    <div id="line">
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
                            <div class="line"></div>
                                <input type="submit" class="i-submit" value="Найти"/>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="coll right">
                    <div class="modul one">

                            <p class="phone">+7 (343) 201-36-06</p>
                            <a href="/evackuator">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                    <div class="modul second">
                            <p class="question">Есть вопросы?<br>
                                <span>Напиши нам</span>
                            </p>
                            <a href="#popup" class="modal">
                               Задать вопрос
                            </a>
                    </div>
                </div>  

                <div class="clear"></div>
            </div>
        </div>  
<?//=$this->renderPartial('//forms/bookPart',array('model'=>new Bookpart));?>
