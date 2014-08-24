<?
	$itemView=get_class($dataProvider->model)=="UsedCars" ? '_carCaruselItem' : '_partsItem';
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>$itemView,
	    'pagerCssClass' => 'pagination',
	    'itemsTagName'=>'div',
	    'template'=>'{items}',
	    'htmlOptions'=>array('class'=>'items-auto'),
	    'pager' => false
	));
?>
<div class="total" style="display:none;">
	<?=$dataProvider->totalItemCount?>
</div>