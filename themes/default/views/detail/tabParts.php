<?
if (!empty($dataProvider))
{
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_itemParts',
        'summaryText' => 'Всего результатов - <span>{count}</span>, показано с {start} по {end}',
        'pagerCssClass' => 'pagination',
        'itemsTagName'=>'ul',
        'ajaxUpdate'=>true,
        'template'=>'{items}{pager}{summary}{sorter}',
        'id'=>'part_list',
        'pager' => array(
            'prevPageLabel' => '',
            'firstPageLabel' => '',
            'nextPageLabel' => '',
            'lastPageLabel' => '',
            'header' => '',
            'cssFile' => false,
        ),
    ));
    Yii::app()->clientScript->registerScript('search','
        changeView();
    ');
}
?>