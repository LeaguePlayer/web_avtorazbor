<div class="page">
	<h1 class="head">
		Результаты поиска по запросу - "<?=$str?>"
	</h1>
	<?$view='_'.$model.'Item';?>
	<div class="wr">
			<div class="content clear">
                <div class="news tab-active" id="tabs-3">
                    <?
						$this->widget('zii.widgets.CListView', array(
						    'dataProvider'=>$dataProvider,
						    'itemView'=>$view,   // refers to the partial view named '_post'
						    'summaryText' => '',
						    'pagerCssClass' => 'pagination',
						    'itemsTagName'=>'div',
						    'pager' => array(
					            'prevPageLabel' => '',
					            'firstPageLabel' => '',
					            'nextPageLabel' => '',
					            'lastPageLabel' => '',
					            'header' => '',
					            'cssFile' => false,
					       	),
						));
                    ?>
                </div>
                
			</div>
	</div>
</div>	