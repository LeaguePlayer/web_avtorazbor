<div class="page">
        	<h1 class="head">
        		Новые автомобили в разборе
        	</h1>

        	<div class="wr">

        			<div class="tabs">
        				<ul>
                            <li class="active">
                                <a href="#tabs-3" >
                                    Поступили в разбор
                                </a>    
                            </li>
                            <li>
                                <a href="#tabs-4" >
                                    Поступили в продажу
                                </a>    
                            </li>
        				</ul>
        			</div>

        			<div class="content clear">

                        <div class="news tab-active" id="tabs-3">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$razbor),false,true);
                            ?>
                        </div>
                        <div class="news" id="tabs-4">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$cars),false,true);
                            ?>
                        </div>
                        
        			</div>
        	</div>
        </div>	