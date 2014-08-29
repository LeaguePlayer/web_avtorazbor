
<div class="page">
            <h1 class="head">
                Каталог автозапчастей
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul filter">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'parts-form',
                                'action' => $this->createUrl('/detail/disc'),
                                'method'=>'get',
                                'htmlOptions' => array('class' => 'request_form')
                            )) ?>
                        <dl>
                            <?=$form->hiddenField($searchForm,'display')?>
                            <?=$form->hiddenField($searchForm,'scenario',array('value'=>'disc'))?>
                            <?=$form->hiddenField($searchForm,'sort')?>
                            <?=$form->hiddenField($searchForm,'category_id',array('value'=>295))?>
                            <dt>
                                Диаметр (дюймы):
                            </dt>
                            <dd id="slider">
                                <div class="formCost">
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'diametr_st')?>
                                    
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'diametr_end')?>
                                </div>
                                </div>
                                <div class="calculate">
                                    <div class="partPrice" data-min="#SearchFormOnMain_diametr_st" data-max="#SearchFormOnMain_diametr_end">
                                    </div>
                                </div>
                            </dd>

                            <dt>
                                Цена (руб):
                            </dt>
                            <dd id="slider-2">
                                <div class="formCost">
                                    <div class="i-text">
                                     <?=$form->textField($searchForm,'price_st')?>
                                </div>
                                    <label for="maxCost">-</label> 
                                <div class="i-text">
                                    <?=$form->textField($searchForm,'price_end')?>
                                </div>
                                </div>

                                <div class="calculate">
                                    <div class="partPrice" data-min="#SearchFormOnMain_price_st" data-max="#SearchFormOnMain_price_end">
                                    </div>
                                </div>
                            </dd>
                            
                            <dd class="submit">
                                <a href="/detail/disc" class="i-submit" >Сбросить</a>
                            </dd>
                        </dl> 
                        <?$this->endWidget()?>
                    </div>
                </div>

                <div class="coll-right">
                    <div class="tabs parts">
                        <ul id="car_type">
                            <li >
                                <a href="/detail?light=1" data-type="1">
                                    Легковые
                                </a>
                            </li>
                            <li >
                                <a href="/detail?hard=1" data-type="2">
                                    Грузовые
                                </a>    
                            </li>
                            <li class="active">
                                <a href="#" data-type="2">
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
                                            Все(41)
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
                                            <li class="active" data-sort="price_sell">
                                                <a href="/detail/disc?sort=price_sell">
                                                    Цене
                                                </a>
                                            </li>
                                            <li data-sort="name">
                                                <a href="/detail/disc?sort=name" >
                                                    Названию
                                                </a>
                                            </li>
                                            <li data-sort="value">
                                                <a href="/detail/disc?sort=value" >
                                                    Диаметру
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