<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cart-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>
<div class="items">
<?
	$this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$model->getItemsSearch(),
	    'columns'=>array(
	    		'id',
	    		'part.name',
	    		'part.price_sell',
	    		'part_count',
	    		array(
	    			'header'=>'Стоимость',
	    			'value'=>'$data->part_count*$data->part->price_sell'
	    		)
	    	),
		)
	);
?>
</div>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/cart/list')); ?>
	</div>

<?php $this->endWidget(); ?>
<style>
	.items{
		position: relative;
		width: 980px;
	}
</style>