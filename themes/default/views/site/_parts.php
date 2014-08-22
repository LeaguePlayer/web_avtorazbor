<?
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'_partsItem',
	    'pagerCssClass' => 'pagination',
	    'itemsTagName'=>'div',
	    'template'=>'{items}',
	    'id'=>'car_carusel',
	    'pager' => false
	));
?>