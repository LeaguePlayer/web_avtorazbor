
<?
	if (empty($models))
	{
		$models=array();
	}
		
	echo CHtml::dropDownList($options['name']  ? $options['name'] : $modelName , 'type', $models, (!empty($options) ? $options : array('empty'=>'Выберите значение','class'=>'select', 'id' => $modelName)));
	
?>