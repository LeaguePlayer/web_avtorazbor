	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'brand', CHtml::listData(CarBrands::model()->findAll(), 'id', 'name')); ?>