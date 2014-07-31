<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_carCaruselItem',
	    'pagerCssClass' => 'pagination',
	    'itemsTagName'=>'ul',
	    'template'=>'{items}',
	    'id'=>'car_carusel',
	    'pager' => false
	));
?>