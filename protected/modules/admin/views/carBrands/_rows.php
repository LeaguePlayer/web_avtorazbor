	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'id_country', CHtml::listData(Country::model()->findAll(),'id','name'), 
													array(
														'empty'=>'Выберите страну',
														'class'=>'span8', 
														'displaySize'=>1, 
														'id' => 'car_type'
													)); 
	?>