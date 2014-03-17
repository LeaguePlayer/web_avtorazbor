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

	public function actionAllJson($q){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{Locations}}')
			->where(array('like', 'name', '%'.$q.'%'))
			->queryAll();

		array_unshift($result, array('id' => 0, 'text' => 'Нет'));

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionGetOneById($id){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{Locations}}')
			->where('id=:id', array(':id' => $id))
			->queryRow();

		if($result) echo CJSON::encode($result);
		else echo CJSON::encode(array('id' => 0, 'text' => 'Нет'));

		Yii::app()->end();
	}
}
