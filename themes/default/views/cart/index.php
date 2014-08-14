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
                                <?
                                if (!Yii::app()->user->isGuest && count($models)){
                                ?>
        			<li>
        				<a href="#accept">
        					Шаг 2: Подтверждение
        				</a>	
        			</li>
                                <?}?>
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
        								Цена
        							</th>
        							<th>
        								Количество
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
        			</div>
                        <a href="#" class="back">Вернуться в каталог</a>
                        <?
                        if (!Yii::app()->user->isGuest && count($models)){
                        ?>
                        <div id="accept" class="baskets">
                                <a href="/cart/Issue_the_order" class="i-submit">Оформить аказ</a>
                        </div>
                        <?}?>
                        <?
                                if (Yii::app()->user->isGuest)
                                {
                                        ?>
                                                <a class="i-submit" href="/account/login?return=cart">Авторизируйтесь</a>
                                        <?
                                }
                        ?>
                </div>
        </div>
</div>	