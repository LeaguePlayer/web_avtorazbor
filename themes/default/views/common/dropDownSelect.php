
<?

	if (empty($models))
	{
		$models=array();
	}

	echo CHtml::dropDownList($Options['name'],'',$models, (!empty($Options) ? $Options : array()));


?>