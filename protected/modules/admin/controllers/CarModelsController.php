<?php

class CarModelsController extends AdminController
{
	public function actionAnalogModels($id, $q){
		header('Content-type: application/json');

		$data = Yii::app()->db->createCommand()
            ->select('m.id, CONCAT(b.name, " ", m.name) as text')
            ->from('{{CarModels}} m')
            ->join('{{CarBrands}} b', 'm.brand = b.id')
            ->where('m.id != :id AND CONCAT(b.name, " ", m.name) LIKE "%'.$q.'%"', array(':id' => $id))
            ->queryAll();

		if($data){
			echo CJSON::encode($data);
		}

		Yii::app()->end();
	}
}
