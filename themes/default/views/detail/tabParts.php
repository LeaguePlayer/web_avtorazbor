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
        'template'=>'{items}{pager}{summary}',
        'id'=>'part_list',
        'beforeAjaxUpdate'=>'function(){

            var $_curHeight=$(".auto").height();
            $(".auto").height($_curHeight);

            $("#part_list").empty();

            $(".loader").css("display","block");

            $(document).scrollTo( $(".menu").offset().top, 800, {queue:true} );
        }',
        'afterAjaxUpdate'=>'js: function(){
            $(".loader").css("display","none");
            return false;
        }',
        'pager' => array(
            'prevPageLabel' => '',
            'firstPageLabel' => '',
            'nextPageLabel' => '',
            'lastPageLabel' => '',
            'header' => '',
            'cssFile' => false,
        ),
    ));
}
?>