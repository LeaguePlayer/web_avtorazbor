<?php

class LocationsController extends AdminController
{
	public function actionAddTag(){
		
		if(isset($_POST['Tag']) && !empty($_POST['Tag'])){

			$model = Locations::model()->find('name=:name', array(':name' => $_POST['Tag']));

			if(!$model){
				$model = new Locations;
				$model->name = $_POST['Tag'];
				$model->save();
			}

			$result = array('id' => $model->id, 'data' => Locations::getListForSelect());
			echo CJSON::encode((object) $result);
		}

		Yii::app()->end();
	}
}
