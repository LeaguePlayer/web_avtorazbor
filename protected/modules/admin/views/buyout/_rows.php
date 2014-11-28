	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'brand',
		CHtml::listData(CarBrands::model()->findAll(),'id','name'),
		array(
				'empty'=>'Выберите марку авто',
				'class'=>'span8',
				'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('/buyout/getModels'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					'update'=>'#Buyout_car_model_id', //selector to update
				)
			)
		); 
	?>

	<?php echo $form->dropDownListControlGroup($model,'car_model_id',
		CHtml::listData(CarModels::model()->findAll('brand=:brand',array(':brand'=>$model->brand)),'id','name'),
		array('class'=>'span8','maxlength'=>255)); ?>
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
	<?php echo $form->textFieldControlGroup($model,'year',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'capacity',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'transmission',array('class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Buyout::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('parts', '
    $(".fancybox").fancybox();
', CClientScript::POS_READY);
?>