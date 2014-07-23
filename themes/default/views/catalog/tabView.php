<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_tabItem',   // refers to the partial view named '_post'
	    'summaryText' => 'Всего результатов - '.
	    	$dataProvider->totalItemCount.', показано с '.($_GET['page'] ? $_GET['page'] : 1 ).' по '.$dataProvider->itemCount*((int)$_GET['page'] ? (int)$_GET['page'] : 1)+ ,
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
		
		$('.pagination a').click(function(){

			var data=methods['catalog'].apply(this,[])

	    	$.fn.yiiListView.update('car_list',data);
		})
	    		
	"
	);
?>