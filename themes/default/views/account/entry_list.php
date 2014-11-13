<div class="page">
        	<h1 class="head">
        		Список заказов
        	</h1>
        	<div class="wr">
        		<div class="coll left">
        			<div class="content clear">
        				<div id="accordion">
						  <?
						  	if ($models)
						  	foreach ($models as $key => $value) {
						  		echo $this->renderPartial('_bookList',array('data'=>$value));
						  	}
						  	else 
						  		print('Для данного аккаунта не было найдено заявок!');
						  ?>
        				</div>
        			</div>
        		</div>
        		<div class="coll right">
                    <div class="modul one">

                            <p class="phone">+7 (343) 201-36-06</p>
                            <a href="/evackuator">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                    <div class="modul second">
                            <p class="question">Есть вопросы?<br>
                                <span>Напиши нам</span>
                            </p>
                            <a href="#popup" class="modal">
                                Задать вопрос
                            </a>
                    </div>
                </div>  

        		<div class="clear"></div>
        	</div>
        </div>	
        <div class="messages">
            <p class="content">
                <?=$this->message?>
            </p>
        </div>