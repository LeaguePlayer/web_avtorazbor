<div class="page">
        <h1 class="head">
        	Оформление заказа
        </h1>

        <div class="wr basket">

        	<div class="tabs">
        		<ul>
        			<li class="active">
        				<a href="#cart">
        					Шаг 1: Состав заказа
        				</a>
        			</li>
                                
        			<li class="<?=!Yii::app()->user->isGuest && count($models)? '' : 'hide'?>">
        				<a href="#accept">
        					Шаг 2: Подтверждение
        				</a>	
        			</li>
        		</ul>
        	</div>
        		<div class="content clear">
        			<div class="bascet tab-active" id="cart">
        				<table width="100%">
        					<thead>
        						<tr>
        							<th width="235px">
        								Фото
        							</th>
                                    <th>
                                            Артикул
                                    </th>
        							<th>
        								Название
        							</th>
        							<th>
        								Стоимость
        							</th>
        							<th width="24px">

        							</th>	
        						</tr>
        					</thead>
        					<tbody>
                                <?

                                    foreach ($models as $key => $cartItem) {

                                            print($this->renderPartial('cartItem',array('data'=>$cartItem),true));
                                    }
                                ?>
        					</tbody>
        				</table>
                                        <a href="<?=$this->createUrl('/detail/parts?'.Yii::app()->session->get('backToResult'))?>" class="back">Вернуться в каталог</a>
        			</div>
                        <div id="accept" class="baskets hide">
                                <dl class="info">
                                    <dt>
                                        Внимание!!! Перед оплатой необходимо уточнить наличие товара на складе у наших менеджеров.
                                    </dd>
                                    <dd>
                                        Режим отправки товаров в регионы:
                                        пн-пт: отгрузка 1 раз в день в 9:30-10:00
                                        сб-вс: отгрузка не производится
                                    </dd>
                                    <dd>
                                        Товар резервируется на 3 рабочих дня.
                                        Отгрузка происходит, после оплаты, в течении 1 рабочего дня. По выходным и праздничным дням, отгрузка не производится.
                                        Обработка заказа менеджером происходит в течении 1 рабочего дня.
                                    </dd>
                                </dl>
                                <div class="user">
                                <?

                                    $this->renderPartial('user',array('model'=>$model));
                                ?>
                                </div>
                                <!-- <a href="/cart/Issue_the_order" class="i-submit right">Оформить аказ</a> -->
                        </div>
                        
                        <?if (Yii::app()->user->isGuest){?>
                            <a class="i-submit right auth" href="#login">Авторизируйтесь</a>
                        <?}?>
                </div>
        </div>
</div>	
<?//$this->renderPartial('//account/loginFromCart',array('model'=>new AuthForm))?>