<?

	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_tabItem',   // refers to the partial view named '_post'
	    'summaryText' => '',
	    'pagerCssClass' => 'pagination',
	    'itemsTagName'=>'ul',
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