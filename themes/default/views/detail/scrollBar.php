<div class="coll-left">
    <div class="modul zp" id="scrollbar">
        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
        <div class="viewport" style="top:0">
             <div class="overview">
<? if (!empty($dataProvider))
{

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_scrollBarItem',
        'pagerCssClass' => 'pagination',
        'itemsTagName'=>'ul',
        'ajaxUpdate'=>false,
        'template'=>'{items}',
        'id'=>'part_list',
        'pager' =>false,
    ));
}
?>
        </div> 
        </div> 
    </div>
</div>