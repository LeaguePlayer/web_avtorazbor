<?php

class EmployeesController extends AdminController
{
	public function actionAddTag(){
		
		if(isset($_POST['Tag']) && !empty($_POST['Tag'])){

			$model = Employees::model()->find('fio=:fio', array(':fio' => $_POST['Tag']));

			if(!$model){
				$model = new Employees;
				$model->fio = $_POST['Tag'];
				$model->save();
			}

			$result = array('id' => $model->id, 'data' => Employees::getListForSelect());
			echo CJSON::encode((object) $result);
		}

		Yii::app()->end();
	}
}
