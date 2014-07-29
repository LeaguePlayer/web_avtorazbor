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
                            <ul>
                                <?=$this->renderPartial('//detail/scrollBar',array('dataProvider'=>$dataProvider),true);?>
                            </ul>
                        </div> 
                        </div> 
                    </div>
                </div>

                <div class="coll-right">

                    <div class="content clear">

                        <div class="gallery">
                            <div class="big-img">
                                <img width="331" height="192" src="images/zp1.jpg" alt="" title="" />
                            </div>
                            <div class="min-img">
                                <ul>
                                    <li>
                                        <img src="images/zp2.jpg" alt=""  title="" />
                                    </li>
                                    <li>
                                        <img src="images/zp2.jpg" alt=""  title="" />
                                    </li>
                                    <li>
                                        <img src="images/zp2.jpg" alt=""  title="" />
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="desc">

                            <ul>
                                <li>
                                    Раздел: <a href="#"><?=$model->category->name;?></a>
                                </li>
                                <li>
                                    Модель авто: <a href="#"><?=$model->car_model->name;?></a>
                                </li>
                                <li>
                                    Кол-во: нет поля
                                </li>
                                <li>
                                    Артикул: <?=$model->id?>
                                </li>
                                <li>
                                    Комментарий: <?=$model->comment?>
                                </li> 
                                <li>
                                    Цена: <?=$model->price_sell?> руб.
                                </li>     
                            </ul>
                            <div class="submit">
                                <input type="submit" value="В корзину" class="i-submit" />
                            </div>

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