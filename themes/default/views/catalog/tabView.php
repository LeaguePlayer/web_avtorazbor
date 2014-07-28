<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_tabItem',   // refers to the partial view named '_post'
	    'summaryText' => 'Всего результатов - {count}, показано с {start} по {end}',
	    'pagerCssClass' => 'pagination',
	    'itemsTagName'=>'ul',
	    'id'=>'ajaxListView',
	    'ajaxUpdate'=>true,
	    'template'=>'{items}{pager}{summary}',
	    'id'=>'car_list',
	    'pager' => array(
            'prevPageLabel' => '',
            'firstPageLabel' => '',
            'nextPageLabel' => '',
            'lastPageLabel' => '',
            'header' => '',
            'cssFile' => false,
      	),
	));

	Yii::app()->clientScript->registerScript('search',
	    "
		
		$.fn.yiiListView.update('car_list');
		// $('.pagination a').click(function(){

		// 	var data=methods['catalog'].apply(this,[])

	 //    	$.fn.yiiListView.update('car_list',data);
		// })
	    		
	"
	);
?>