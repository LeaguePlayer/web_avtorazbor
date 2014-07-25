
<div class="page">
            <h1 class="head">
                Двигатель без головки блока 0.8 л
            </h1>

            <div class="wr">

                <div class="coll-left">
                    <div class="modul zp" id="scrollbar">
                        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                        <div class="viewport">
                             <div class="overview">
                                    <?
                                    $this->widget('zii.widgets.CListView', array(
                                        'dataProvider'=>$dataProvider,
                                        'itemView'=>'_itemParts',   // refers to the partial view named '_post'
                                        'itemsTagName'=>'ul',
                                        'itemsCssClass'=>'items',
                                        'ajaxUpdate'=>false,
                                        'template'=>'{items}',
                                        'id'=>'part_list',
                                    ));
                                ?>
                        </div> 
                        </div> 
                    </div>
                </div>

                <div class="coll-right">

                    <div class="content clear">

                        <div class="part">

                         <? if ($model)
                            print($this->renderPartial('view',array('model'=>$model),true));?>
                        </div>

                        <div class="shared clear">
                            <dl>
                                <dt>
                                    Поделиться:
                                </dt>
                                <dd>
                                    <ul>
                                        <li class="vk">
                                            <a href="#"></a>
                                        </li>
                                        <li class="fb">
                                            <a href="#"></a>
                                        </li>
                                        <li class="gp">
                                            <a href="#"></a>
                                        </li>
                                        <li class="tw">
                                            <a href="#"></a>
                                        </li>
                                        <li class="od">
                                            <a href="#"></a>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>

                        <div class="readmore">
                            <a href="#">
                                Вернуться к результатам поиска
                            </a>
                        </div>

                        <div class="clear"></div>

                    </div>

                    

                </div>


                <div class="clear"></div>
            </div>
        </div>  
        <!--content End-->

        <!--page-->
        <div class="service">
            
        </div>
        <!--page End-->

    </div>