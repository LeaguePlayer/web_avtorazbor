<dl class="bascet">	
                
        		<dt>
        			<strong>В карзине:</strong> 
        		</dt>
        		<dd>
        			<?
                        if (!Yii::app()->cart->isEmpty(1) && $authenticated)
                        {
                    ?><ul>
        				    <li>
        					<a href="/cart"><?=Yii::app()->cart->getItemsCount()?> товар</a>
        				    </li>
        				    <li>
                            <a href="/cart">
        					На сумму: <strong><?=Yii::app()->cart->getCost()?> руб.</strong>
                            </a>
        			     	</li>
        			  </ul>
                    <?} else {?>
                        <span class="empty-cart">
                            нет товаров
                        </span>
                    <?}?>
        		</dd>
                
        	</dl>