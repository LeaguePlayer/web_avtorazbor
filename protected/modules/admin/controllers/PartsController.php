<?php

class PartsController extends AdminController
{

	//create action
	public function actionCreate(){
		$model = new Parts;
		$analogs = $model->getOwnParts($model->car_model_id, $model->category_id, $model->id);

		if(isset($_POST['Parts'])){
			$model->attributes = $_POST['Parts'];

			if($model->save()){
				
				if(!$this->saveAnalogs($model))
					$this->redirect($this->createUrl('update', array('id' => $model->id)));

				$this->redirect($this->createUrl('list'));
			}	
		}

		$this->render('create', array(
			'model' => $model,
			'analogs' => $analogs
		));
	}

	//action update
	public function actionUpdate($id){
		$model = Parts::model()->findByPk($id);
		$analogs = $model->getOwnParts($model->car_model_id, $model->category_id, $model->id);

		$model->price_sell = number_format($model->price_sell, 0, '', '');
		$model->price_buy = number_format($model->price_buy, 0, '', '');

		if(isset($_POST['Parts'])){

			$model->attributes = $_POST['Parts'];

			if($model->save()){
				$this->attachUsedCar($model);
				
				if(!$this->saveAnalogs($model))
					$this->redirect($this->createUrl('update', array('id' => $model->id)));

				$this->redirect($this->createUrl('list'));
			}	
		}

		$this->render('update', array(
			'model' => $model,
			'analogs' => $analogs
		));
	}

	//export to Excel
	public function actionToExcel(){
		Yii::app()->excel->exportModel('Parts', array(), array(
			'location_id' => '$data->location->name',
			'car_model_id' => '$data->car_model->car_brand->name.\' \'.$data->car_model->name',
			'status' => 'Parts::getStatusAliases($data->status)',
			'create_time' => 'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time))'
		));

		Yii::app()->end();
	}

	//export to Excel
	public function actionSendExcel(){

		if(isset($_POST['Email'])){
			if($_POST['Email']['email'] != ''){

				$documentPath = Yii::app()->excel->exportModel('Parts', array(), array(
					'location_id' => '$data->location->name',
					'car_model_id' => '$data->car_model->car_brand->name.\' \'.$data->car_model->name',
					'status' => 'Parts::getStatusAliases($data->status)',
					'create_time' => 'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time))'
				), true);
				try {
					echo Yii::app()->swiftmail->sendEmail(array('test@test.ru' => 'Test'), $_POST['Email']['email'], 'Excel файл запчастей.', 'Excel файл запчастей.', array($documentPath));
				} catch (Swift_RfcComplianceException $e) {
					echo 0;
					Yii::app()->end(200);
				} catch (Swift_TransportException $e){
					echo 0;
					Yii::app()->end(200);
				}
				
			}
		}

		echo 0;

		Yii::app()->end(200);
	}

	public function actionGetPartsByModelCat($model_id, $cat_id, $part_id = null){
		
		$model = $part_id ? Parts::model()->findByPk($part_id) : new Parts;
		$parts = $model->getOwnParts($model_id, $cat_id);

		if($parts){
			$this->renderPartial('_analogs', array(
				'analogs' => $parts
			));
		}

		Yii::app()->end();
	}

	public function actionGetAnalogModels($car_model_id, $cat_id){
		header('Content-type: application/json');

		$result = array();
		$analogs = CarModels::getAnalogsModels($car_model_id, $cat_id);

		foreach ($analogs as $item) {
			$result[] = (object) array('id' => $item->id, 'text' => $item->car_brand->name." ".$item->name);
		}

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	private function saveAnalogs($model){
		
		if(isset($_POST['Analogs_delete']) && !$model->isNewRecord){
			foreach ($_POST['Analogs_delete'] as $id) {
				$a = Analogs::model()->find('(model_1=:m AND cat_id=:cat) OR (model_2=:m AND cat_id=:cat)', array(
					':m' => $id, 
					':cat' => $model->category_id
				));

				if($a) $a->delete();
			}
		}

		if(isset($_POST['Analogs']) && !empty($_POST['Analogs'])){

			$analogs = explode(',', $_POST['Analogs']);

			$exist_analogs = CarModels::findAllModelAnalogs($model->car_model_id, $model->category_id);

			foreach ($analogs as $val) {
				$analog = new Analogs;

				if(in_array($val, $exist_analogs)) continue;

				$analog->model_1 = $model->car_model_id;
				$analog->model_2 = $val;
				$analog->cat_id = $model->category_id;

				$analog->save();		

				if(!$analog->save()) return false;
			}
		}

		return true;
	}

	//attach used car to part
	private function attachUsedCar($model){

		if(isset($_POST['UsedCar'])){
			$db = Yii::app()->db->createCommand();

			if(!empty($_POST['UsedCar'])){
				
				if($model->usedCar) //already add then update
					$db->update('{{Parts_UsedCars}}', array('used_car_id' => $_POST['UsedCar']), 'parts_id=:p', array(':p' => $model->id));
				else //not add then insert
					$db->insert('{{Parts_UsedCars}}', array('parts_id' => $model->id, 'used_car_id' => $_POST['UsedCar']));
			}else{ 
				if($model->usedCar) //delete relation
					$db->delete('{{Parts_UsedCars}}', 'parts_id=:p', array(':p' => $model->id));
			}
		}
	}
}
