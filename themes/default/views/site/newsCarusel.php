<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_newsCaruselItem',   // refers to the partial view named '_post'
	    'itemsTagName'=>'div',
	    'htmlOptions'=>array(
	    	'class'=>'news-items'
	    ),
	    'ajaxUpdate'=>false,
	    'template'=>'{items}',
	    'pager' => false
	));

?>