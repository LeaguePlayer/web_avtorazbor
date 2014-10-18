<div class="page">
        	<h1 class="head">
        		Новинки автокаров
        	</h1>

        	<div class="wr">

        			<div class="tabs">
        				<ul>
                            <li class="active">
                                <a href="#tabs-3" >
                                    Новинки
                                </a>    
                            </li>
        				</ul>
        			</div>

        			<div class="content clear">

                        <div class="news tab-active" id="tabs-3">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$model),false,true);
                            ?>
                        </div>
                        
        			</div>
        	</div>
        </div>	