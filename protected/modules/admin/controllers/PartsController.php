<?php

class PartsController extends AdminController
{

	//create action
	public function actionCreate(){
		$model = new Parts;
		$analogs = $model->getOwnParts($model->car_model_id, $model->category_id, $model->id);

		if(isset($_POST['Parts'])){
			$model->attributes = $_POST['Parts'];

			$model->name = $model->category->name.", ".$model->car_model->car_brand->name." ".$model->car_model->name;
			if($model->save()){
				$this->attachUsedCar($model);
				
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

			$model->name = $model->category->name.", ".$model->car_model->car_brand->name." ".$model->car_model->name;
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

	public function actionView($id){

		$model = Parts::model()->findByPk($id);
		if(!$model)
			throw new CHttpException(404, 'Запчасть не найдена.');

		if(isset($_POST['Parts'])){

			$model->attributes = $_POST['Parts'];

			$model->validate();
			if($model->update(array('comment')))
				$this->redirect($this->createUrl('view', array('id' => $id)));
		}

		$analogs = $model->getOwnParts($model->car_model_id, $model->category_id, $model->id);

		$this->render('view', array('model' => $model, 'analogs' => $analogs));
	}

	public function actionDelete($id){

		$model = Parts::model()->findByPk($id);
		if(!$model)
			throw new CHttpException(404, 'Запчасть не найдена.');

		if($model->status != Parts::STATUS_REMOVED){
			$model->status = Parts::STATUS_REMOVED;
			$model->save(false, array('status'));
		}else
			$model->delete();

		Yii::app()->end();
	}

	//export to Excel
	public function actionToExcel(){

		$model = new Parts;
		if(isset($_GET['Parts']))
    		$model->attributes = $_GET['Parts'];

		Yii::app()->excel->exportModel('Parts', $model->search()->data, array(), array(
			'location_id' => '$data->location ? $data->location->name : \'\'',
			'car_model_id' => '$data->car_model ? $data->car_model->car_brand->name.\' \'.$data->car_model->name : \'\'',
			'status' => 'Parts::getStatusAliases($data->status)',
			'create_time' => 'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time))'
		));

		Yii::app()->end();
	}

	//send Excel file by email
	public function actionSendExcel(){

		if(isset($_POST['Email'])){
			if($_POST['Email']['email'] != ''){

				$model = new Parts;
				if(isset($_POST['Parts']))
            		$model->attributes = $_POST['Parts'];

				$documentPath = Yii::app()->excel->exportModel('Parts', $model->search()->data, array(), array(
					'location_id' => '$data->location ? $data->location->name : \'\'',
					'car_model_id' => '$data->car_model ? $data->car_model->car_brand->name.\' \'.$data->car_model->name : \'\'',
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

	public function actionAllJson($q, $req_id){
		header('Content-type: application/json');

		$request = Requests::model()->findByPk($req_id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена');

		$notIn = array();

		$notIn[] = Parts::STATUS_RESERVED;
		$notIn[] = Parts::STATUS_UTIL;
		$notIn[] = Parts::STATUS_SUCCESS;
		$notIn[] = Parts::STATUS_CLOSED;

		//get parts belongs to request
		$req_parts = Yii::app()->db->createCommand()
			->select('p.id')
			->from('{{Parts}} as p')
			->join('{{PartsInRequest}} as pr', 'p.id=pr.part_id')
			->where('pr.request_id = :req_id', array(':req_id' => $request->id))
			->queryColumn();

		//print_r($req_parts); die();

		//$req_parts = implode(',', $req_parts);

		$command = Yii::app()->db->createCommand()
			->select('p.id, CONCAT(p.id," - ",p.name) as text')
			->from('{{Parts}} as p')
			->leftJoin('{{PartsInRequest}} as pr', 'p.id=pr.part_id')
			->andWhere('status=:status', array(':status' => Parts::STATUS_PUBLISH))
			->andWhere(array('not in', 'p.id', $req_parts));
			// ->andWhere('pr.part_id IS NULL')
			// ->andWhere('pr.request_id != :req_id OR pr.request_id IS NULL', array(':req_id' => $request->id))
			// ->andWhere(array('not in', 'status', $notIn))
			

		if(is_numeric($q)){
			$command->andWhere('p.id=:pid', array(':pid' => $q));
		}else
			$command->andWhere(array('like', 'name', '%'.$q.'%'));

		// var_dump(is_numeric($q));
		// print_r($command->query()); die();

		$command->setDistinct(true);
		$result = $command->queryAll();

		// var_dump($result); die();
		//array_unshift($result, array('id' => 0, 'text' => 'Нет'));
		// print_r($result);
		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionRemoved(){
		$this->layout = '/layouts/custom';
		
		$model = new Parts;

		if(isset($_GET['Parts']))
			$model->attributes = $_GET['Parts'];

		$data = $model->deleted();

		$this->render('removed_list', array('model' => $model, 'data' => $data));
	}

	public function actionUtilizationList(){
		$this->layout = '/layouts/custom';
		
		$model = new Parts;

		if(isset($_GET['Parts']))
			$model->attributes = $_GET['Parts'];

		$data = $model->utilization();

		$this->render('utilization_list', array('model' => $model, 'data' => $data));
	}

	public function actionDeleteFromUtilization($id){

		$model = Parts::model()->findByPk($id);
		if(!$model)
			throw new CHttpException(404, 'Запчасть не найдена.');

		$model->status = Parts::STATUS_PUBLISH;
		$model->update(array('status'));

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

	public function actionChangeStatus($id){
		
		if(isset($_POST['val']) && $_POST['val'] >= 0){
			
			$model = Parts::model()->findByPk($id);
			if(!$model)
				throw new CHttpException(404, 'Запчасть не найдена.');

			$model->status = $_POST['val'];
			$model->save(false, array('status'));
		}
	}

	/*public function actionGetOneById($id){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{Parts}}')
			->where('id=:id', array(':id' => $id))
			->queryRow();

		if($result) echo CJSON::encode($result);
		else echo CJSON::encode(array('id' => 0, 'text' => 'Нет'));

		Yii::app()->end();
	}*/
}