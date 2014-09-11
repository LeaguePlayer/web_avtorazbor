<div class="alert qst" id="alert">
	<p class="caption">
		Товар добавлен в корзину
	</p>
	<div class="part"><img src="\media/images\parts\1289\2854normal.jpg" alt="">

                            <ul>
                                <li>
                                    Раздел: <?=$model->category->name?>
                                </li>
                                <li>
                                    Модель авто: <?=$model->car_model->name?>
                                </li>
                                <li>
                                   Артикул:  <span class="articl"><?=$model->id?></span>
                                </li>
                                <li>
                                    Комментарий: <?=$model->comment?>                     
                                </li> 
                                <li>
                                    Цена: <?=$model->price_sell?> руб.
                                </li>  
                            </ul>
                        </div>
	<div class="message">
		<a class="totalPrice i-submit" href="/cart">В корзине <?=Yii::app()->cart->getCount()?> товар на сумму <?=Yii::app()->cart->getCost()?> руб.</a>
        <div class="hr"></div>
        <a href="#" class="stay i-cancel">Продолжить покупку</a>
	</div>
</div>