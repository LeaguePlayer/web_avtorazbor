
<?
	if (empty($models))
	{
		$models=array();
	}

	echo CHtml::dropDownList($model, 'type', $models, array('empty'=>'Выберите значение','class'=>'select', 'id' => $modelName));
	
?>