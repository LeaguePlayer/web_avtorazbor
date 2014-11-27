<div class="page">

        	<h1 class="head">
        		Все услуги
        	</h1>

            <div class="wswg_content">
               <?=$content?>
            </div>

        	<div class="wr">
                <div class="service">
                    <ul>
                        <li class="icon sale">
                            <a href="/catalog">
                                <i></i>
                                <span class="h">Продажа авто</span>
                                <span class="d">Крупнейший парк<br> битых авто в Тюмени</span>
                            </a>
                        </li>
                        <li class="icon zp old">
                            <a href="/detail">
                                <i></i>
                                <span class="h">Автозапчасти</span>
                                <span class="d">Огромный выбор<br> запчастей с разбора</span>
                            </a>
                        </li>
                        <li class="icon spec">
                            <a href="/page/Spec-tehnika">
                                <i></i>
                                <span class="h">Спецтехника</span>
                                <span class="d">Продаем<br> подержанную спецтехнику</span>
                            </a>
                        </li>
                        <li class="icon transport old">
                            <a href="/page/Avtoperevozki">
                                <i></i>
                                <span class="h">Автоперевозки</span>
                                <span class="d">Автомобильные перевозки<br>
                                в Тюмени и области</span>
                            </a>
                        </li>
                        <li class="icon buying">
                            <a href="/buyout">
                                <i></i>
                                <span class="h">Выкуп авто</span>
                                <span class="d">Выкуп автомобилей<br> после ДТП, пожара и т.п.</span>
                            </a>
                        </li>
                        <li class="icon med old">
                            <a href="/evackuator">
                                <i></i>
                                <span class="h">Эвакуатор,манипулятор</span>
                                <span class="d">Эвакуация авто из любой точки<br>вашего города</span>
                            </a>
                        </li>
                        <li class="icon argon">
                            <a href="/page/Argonavaya-svarka">
                                <i></i>
                                <span class="h">Аргон-сварка</span>
                                <span class="d">Сварка аргоном с использованием<br> высококачественного оборудования</span>
                            </a>
                        </li>
                        <li class="icon diagnost old">
                            <a href="/page/Diagnostika">
                                <i></i>
                                <span class="h">Диагностика автомобиля</span>
                                <span class="d">Полный спект услуг по компрьютерной<br>
                                диагностике автомобиля</span>
                            </a>
                        </li>
                    </ul>
                </div>
        	</div>

            <!--slider-->
         <div class="page new ">
            <div class="wr">

                <div class="coll left full-width">
                    <div class="tabs">
                        <ul>
                            <li class="active">
                                <a href="#tabs-5">
                                    Поступили в продажу
                                </a>
                            </li>
                            <li >
                                <a href="#tabs-6">
                                    Поступили в разбор
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="content clear">
                        <div id="tabs-5" class="tab-active">
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('//site/newsCarusel',array('dataProvider'=>$cars),true)?>
                        </div>
                        <div id="tabs-6">
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('//site/newsCarusel',array('dataProvider'=>$razbor),true)?>
                        </div>
                    </div>
                </div>
            <!--slider End-->
            <div class="clear"></div>
        </div>	
        <!--content End-->
</div>