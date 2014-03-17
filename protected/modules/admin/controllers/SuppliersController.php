<?php

class SuppliersController extends AdminController
{

	public function actionAddTag(){
		
		if(isset($_POST['Tag']) && !empty($_POST['Tag'])){

			$model = Suppliers::model()->find('name=:name', array(':name' => $_POST['Tag']));

			if(!$model){
				$model = new Suppliers;
				$model->name = $_POST['Tag'];
				$model->save();
			}

			$result = array('id' => $model->id, 'data' => Suppliers::getListForSelect());
			echo CJSON::encode((object) $result);
		}

		Yii::app()->end();
	}
}
