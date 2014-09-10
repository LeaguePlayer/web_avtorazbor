<div class="page">

        	<h1 class="head paragraph">
        		Все услуги
        	</h1>

            <p class="desc-text">
                Мы занимаемся автомобилями уже более 10 лет. За это время наша компания накопила огромный опыт в сфере авторазбора. В нашем каталоге вы найдете <br>более чем 45 000 запчастей и большое количество битых автомобилей. Каждый день мы разбираем новые автомобили, чтобы вы могли найти практически любую деталь.
            </p>

        	<div class="wr">
                <div class="service">
                    <ul>
                        <li class="icon sale">
                            <a href="/catalog">
                                <i></i>
                                <span class="h">Продажа авто</span>
                                <span class="d">Крупнейший парк<br> битых авто в Екатеринбурге</span>
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
                            <a href="/page/spectehnica">
                                <i></i>
                                <span class="h">Спецтехника</span>
                                <span class="d">Продаем<br> подержанную спецтехнику</span>
                            </a>
                        </li>
                        <li class="icon transport old">
                            <a href="/page/avtoperevozki">
                                <i></i>
                                <span class="h">Автоперевозки</span>
                                <span class="d">Автомобильные перевозки<br>
                                в Екатеринбурге и области</span>
                            </a>
                        </li>
                        <li class="icon buying">
                            <a href="/buy_out">
                                <i></i>
                                <span class="h">Выкуп авто</span>
                                <span class="d">Выкуп автомобилей<br> после ДТП, пожара и т.п.</span>
                            </a>
                        </li>
                        <li class="icon med old">
                            <a href="#">
                                <i></i>
                                <span class="h">Эвакуатор,манипулятор</span>
                                <span class="d">Эвакуация авто из любой точки<br>вашего города</span>
                            </a>
                        </li>
                        <li class="icon argon">
                            <a href="/page/argon">
                                <i></i>
                                <span class="h">Аргон-сварка</span>
                                <span class="d">Сварка аргоном с использованием<br> высококачественного оборудования</span>
                            </a>
                        </li>
                        <li class="icon diagnost old">
                            <a href="/page/diagnostick">
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
                                    Новинки
                                </a>
                            </li>
                            <li >
                                <a href="#tabs-6">
                                    Новости
                                </a>    
                            </li>
                        </ul>
                    </div>

                    <div class="content clear">
                        <div id="tabs-5" class="tab-active">
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('//site/newsCarusel',array('dataProvider'=>$news->getNews()),true)?>
                        </div>
                        <div id="tabs-6" class="tab-active">
                            <a href="#" class="prev"></a>
                            <a href="#" class="next"></a>
                            <?=$this->renderPartial('//site/newsCarusel',array('dataProvider'=>$news->getCompany()),true)?>
                        </div>
                    </div>
                </div>
            <!--slider End-->
            <div class="clear"></div>
        </div>	
        <!--content End-->

        

    </div>
    <footer>

    	<dl class="copy">
    		<dt>
    			© 2013 ООО «Авторазборка72»
    		</dt>
    		<dd>
    			Использование материалов сайта<br> 
				без согласия правообладателя запрещено
    		</dd>
    	</dl>

    	<div class="mn">

    		<div class="nav">
    			<ul>
    				<li>
        				<a href="#">
        					О компании
        				</a>
        			</li>
        			<li>
        				<a href="#">
        					Продажа авто
        				</a>
        			</li>
        			<li>
        				<a href="#">
        					Автозапчасти
        				</a>
        			</li>
        			<li>
        				<a href="#">
        					Все услуги
        				</a>
        			</li>
        			<li>
        				<a href="#">
        					Новости
        				</a>
        			</li>
        			<li class="active">
        				<a href="#">
        					Контакты
        				</a>
        			</li>
        			<li>
        				<a href="#">
        					Акции
        				</a>
        			</li>
    			</ul>	
    		</div>

    		<div class="block">

    			<div class="tel">
    				8-800-500-2019<br>
					<a href="mailto:info@razbor72.ru">
						info@razbor72.ru
					</a>
    			</div>

    			<div class="search">
    				<input type="text" value="" placeholder="Поиск по сайту">
    				<input type="submit" value="" class="i-submit">
    			</div>
    		</div>	

    		
    	</div>
    	<div class="clear"></div>
    </footer>
    <div id="popup" name="qst" class="qst">
        <div class="bx">

            <dl>
                <dt>
                    Задать вопрос
                </dt>
                <dd>
                    <span class="req">*</span>
                    - поля, обязательные для заполнения
                </dd>
            </dl>
            <div class="form">
                <ul>
                    <li>
                        <label for="name">Ваше Имя <span class="req">*</span></label>
                        <input name="name" type="text" value="" class="i-text" requered="">
                    </li>
                    <li>
                        <label for="tel">Контактный телефон <span class="req">*</span></label>
                        <input name="tel" type="text" value="" class="i-text" requered="">
                    </li>
                    <li>
                        <label for="email">E-mail</label>
                        <input name="email" type="mail" value="" class="i-text">
                    </li>
                    <li class="qsts">
                        <label for="qsts">Ваш вопрос  <span class="req">*</span></label>
                        <textarea name="qsts" requered="" class="i-textarea"></textarea>
                    </li>
                    <li>
                        <label>Тема письма</label>
                        <span class="selectbox" style="display:inline-block;position:relative"><div class="select" style="float:left;position:relative;z-index:10000"><div class="text">
                                Не выбрано
                            </div><b class="trigger"><i class="arrow"></i></b></div><div class="dropdown" style="position: absolute; z-index: 9999; overflow-y: auto; overflow-x: hidden; list-style: none; left: 0px; display: none;"><ul><li class="selected sel">
                                Не выбрано
                            </li><li>
                                Вопрос
                            </li><li>
                                Заявка
                            </li></ul></div></span><select style="position: absolute; top: -9999px;">
                            <option value="0">
                                Не выбрано
                            </option>
                            <option value="1">
                                Вопрос
                            </option>
                            <option value="2">
                                Заявка
                            </option>
                        </select>
                    </li>
                    <li class="sub">
                        <input type="submit" class="i-submit" value="Отправить">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="over" id="hide-layout"></div>


</div>