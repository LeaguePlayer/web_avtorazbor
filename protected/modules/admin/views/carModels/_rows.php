	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'brand', CHtml::listData(CarBrands::model()->findAll(),'id','name')); ?>
	<?php echo $form->dropDownListControlGroup($model, 'car_type', CarModels::getCarTypes(), array('empty'=>'Выберите тип машины', 'class'=>'span8', 'displaySize'=>1, 'id' => 'bascet')); ?>
