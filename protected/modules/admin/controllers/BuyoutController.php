<?php

class BuyoutController extends AdminController
{
	public function actionGetModels(){

		$models=CarModels::model()->findAll('brand=:brand',array(':brand'=>$_POST['Buyout']['brand']));
		if ($models)
		{
			$models=array('empty'=>'Выберите модель авто')+CHtml::listData($models,'id','name');
			foreach ($models as $value => $name) {

				 echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
			}
			Yii::app()->end();
		}
		echo '<option>Для данного бренда не было найдено автомобилей</option>';
		Yii::app()->end();
	}
}
