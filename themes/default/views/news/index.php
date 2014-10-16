<div class="page">
        	<h1 class="head">
        		Обновление за 2014 год
        	</h1>

        	<div class="wr">

        			<div class="tabs">
        				<ul>
        					<li class="active">
        						<a href="#tabs-1">
        							2014
        						</a>
        					</li>
        					<li>
        						<a href="#tabs-2">
        							2013
        						</a>		
        					</li>
                            <li>
                                <a href="#tabs-3">
                                    Новинки
                                </a>    
                            </li>
                            <li>
                                <a href="#tabs-4">
                                    Новости компании
                                </a>    
                            </li>
        				</ul>
        			</div>

        			<div class="content clear">

        				<div class="news tab-active" id="tabs-1">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$model->getCurrentYear()),false,true);
                            ?>
                        </div>
                        <div class="news" id="tabs-2">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$model->getPrevYear()),false,true);
                            ?>
                        </div>
                        <div class="news" id="tabs-3">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$model->getNews()),false,true);
                            ?>
                        </div>
                        <div class="news" id="tabs-4">
                            <?
                                $this->renderPartial('tabView',array('dataProvider'=>$model->getCompany()),false,true);
                            ?>
                        </div>
        			</div>
        	</div>
        </div>	