<?php
?>
<div class="page reg">
        	<h1 class="head">
        		Вакансии
        	</h1>

        	<div class="wr">

        		<div class="coll left">

        			

        			<div class="content clear">

        				<div class="jobs">

                            <dl>
                                <dt>
                                    Здравствуйте! В нашей фирме появились новые вакансии:
                                </dt>
                                <dd>
                                    <?php $this->widget('zii.widgets.CListView', array(
										'dataProvider'=>$dataProvider,
										'itemView'=>'_view',
										'itemsCssClass'=>'',
										'itemsTagName'=>'ul',
										'template'=>'{items}'
									)); ?>
                                </dd>
                                <dt>
                                        телефон для связи <br><strong>8-922-136-06-11</strong> Алексей, <br><strong>8-9222-922-923</strong> Сергей
                                </dt>
                            </dl>
                            
                            <input type="submit" value="Обратная связь" class="i-submit"> 
                        </div>

        			</div>
        		</div>

        		<div class="coll right">
                    <div class="modul one">

                            <p class="phone">+7 (343) 201-36-06</p>
                            <a href="#">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                    <div class="modul second">
                            
                            <p class="question">Есть вопросы?<br>
                                <span>Напиши нам</span>
                            </p>
                            <a href="#">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                </div> 

        		<div class="clear"></div>
        	</div>
        </div>


