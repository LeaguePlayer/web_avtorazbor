<?
	$view='_'.$model.'Item';

	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>$view,
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