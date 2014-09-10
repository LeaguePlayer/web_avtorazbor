<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'//site/_newsCaruselItem',   // refers to the partial view named '_post'
	    'itemsTagName'=>'div',
	    'htmlOptions'=>array(
	    	'class'=>'items-news'
	    ),
	    'ajaxUpdate'=>false,
	    'template'=>'{items}',
	    'pager' => false
	));

?>