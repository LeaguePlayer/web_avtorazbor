<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Просмотр',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
);
?>

<h1><?php echo $model->translition(); ?> - просмотр</h1>

<div class='control-group'>
    <?
        $images=unserialize($model->images);
        if ($images)
            foreach ($images as $key => $img) {
                ?>
                    <a href="<?=$img?>" rel="1" class="fancybox"><img width="150px" src="<?=$img?>" alt=""></a>
                <?
            }
    ?>
</div>

<?
	$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
        'phone',
        'email',
        'car_brand.name',
        'car_model.name',
        'year',
        'capacity',
        array(               // related city displayed as a link
            'label'=>'Тип КПП',
            'type'=>'raw',
            'value'=>UsedCarInfo::transmissionList($model->transmission),
        ),
        'comment',
        'status',
    ),
));
?>

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('parts', '
    $(".fancybox").fancybox();
', CClientScript::POS_READY);
?>