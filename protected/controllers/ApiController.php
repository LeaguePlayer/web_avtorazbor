<?php

class ApiController extends FrontController
{
	private $response;

	public function init(){
		parent::init();

		$response = new stdClass();

		$response->errors = array();
		$response->data = array();

		$this->response = $response;
	}

	public function actionTest(){
		header('Content-Type: application/json');
		$item = Parts::model()->find();
		$this->response->data['item'] = $item;
		echo CJSON::encode($this->response);
		Yii::app()->end();
	}

	/**
	 * Create part and send her id by JSON
	 */
	public function actionCreatePart(){
		header('Content-Type: application/json');

		$part = new Parts;

		$part->name = 'Новая запчасть';
		$part->price_sell = 0;
		$part->price_buy = 0;
		$part->status = Parts::STATUS_DEVICE;

		if($part->save()){
			$this->response->data['id'] = (int) $part->id;
		}else{
			$this->response->errors[] = 'Невозможно создать запчасть.';
		}
		$this->printJSON();
		Yii::app()->end();
	}

	public function actionSavePart($id){
		header('Content-Type: application/json');

		$part = Parts::model()->findByPk($id);

		if(!$part)
			$this->response->errors[] = array('part' => 'Запчасть не найдена');

		if($part && isset($_POST['Parts'])){
			$part->attributes = $_POST['Parts'];
			//create name
			
			if($part->category_id && $part->car_model_id)
			{
				$part->createName();
			}

			if($part->validate()){

				$this->attachUsedCar($part);
				// $part->status = Parts::STATUS_PUBLISH;
				$part->save(false);
				$response->data['save'] = 1;
			}else
				$this->response->errors[] = $part->getErrors();
		}

		$this->printJSON();
		Yii::app()->end();
	}

	//create reserve package
	public function actionReserve($count, $user_id, $secretKey){
		header('Content-Type: application/json');

		if($secretKey == 'RazborApp' && $count > 0 && $user_id > 0){
			for ($i=0; $i < $count; $i++) { 
				$part = new Parts;

				$part->name = 'Резерв';
				$part->price_sell = 0;
				$part->price_buy = 0;
				$part->status = Parts::STATUS_RESERVE_DEVICE;
				$part->user_id = $user_id;

				if($part->validate()){
					$part->save(false);
					$this->response->data[]['id'] = (int) $part->id;
				}
			}
		}else
			$this->response->errors[] = 'Чтото пошло не так.';

		$this->printJSON();

		Yii::app()->end();
	}

	public function actionAddImage($id){
		header('Content-Type: application/json');

		$part = Parts::model()->findByPk($id);

		if(!$part)
			$this->response->errors[] = 'Запчасть не найдена';
		
		if($part){
			$model = new GalleryPhoto();
	        $model->gallery_id = $part->gallery_id;
	        $imageFile = CUploadedFile::getInstanceByName('Image');
	        if($imageFile){

	        	if(!$part->gallery->main) $model->main = 1;

	        	$model->file_name = $imageFile->getName();
	        	$model->ext = $imageFile->extensionName;
        		$model->save();

        		$model->setImage($imageFile->getTempName());

        		$this->printJSON();
        		Yii::app()->end();
	        }
		}
		$this->response->errors[] = 'Чтото пошло не так.';

		$this->printJSON();

		Yii::app()->end();
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

	public function actionAuth(){
		header('Content-Type: application/json');

		Yii::import('user.components.*');
		Yii::import('user.models.*');

		/*if(true){
			$identity=new UserIdentity('admin', 'admin1234');
			$identity->authenticate();*/

		if(isset($_POST['username']) && isset($_POST['pass'])){
			$identity=new UserIdentity($_POST['username'], $_POST['pass']);
			$identity->authenticate();

			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$user = User::model()->notsafe()->findByPk($identity->getId());

					if(!$user->allow_app){
						$this->response->errors[] = 'Доступ запрещен!';
						break;
					}

					$user_info = new stdClass();
					$user_info->id = $user->id;
					$user_info->fio = $user->profile->first_name." ".$user->profile->last_name;

					$this->response->data[]['user'] = $user_info;
					break;
				case UserIdentity::ERROR_EMAIL_INVALID:
					$this->response->errors[] = 'Email is incorrect.';
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->response->errors[] = 'Username is incorrect.';
					break;
				case UserIdentity::ERROR_STATUS_NOTACTIV:
					$this->response->errors[] = 'You account is not activated.';
					break;
				case UserIdentity::ERROR_STATUS_BAN:
					$this->response->errors[] = 'You account is blocked.';
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->response->errors[] = 'Password is incorrect.';
					break;
			}

			$this->printJSON();
		}

		Yii::app()->end();
	}

	/**
	 * Get data for selects
	 */
	public function actionFieldsData(){
		header('Content-Type: application/json');

		//categories
		$data = Yii::app()->db->createCommand()
			->select('id, name')
			->from('{{categories}}')
			->order('name')
			->queryAll();
		$this->response->data['categories'] = $data;

		//car models
		$data = CarModels::brandModelsList();
		$this->response->data['car_models'] = $data;

		//locations
		$data = Yii::app()->db->createCommand()
			->select('id, name')
			->from('{{Locations}}')
			->queryAll();
		$this->response->data['locations'] = $data;

		//suppliers
		$data = Yii::app()->db->createCommand()
			->select('id, name')
			->from('{{Suppliers}}')
			->queryAll();
		$this->response->data['suppliers'] = $data;

		//used cars
		$data = Yii::app()->db->createCommand()
			->select('id, CONCAT("VIN - ", vin) as name')
			->from('{{UsedCars}}')
			->where('status=1')
			->queryAll();
		$this->response->data['bu_cars'] = $data;

		$this->printJSON();

		Yii::app()->end();
	}

	//date format %e.%m.%y
	//delete when finish app
	public function actionGetAllParts($user_id){
		header('Content-Type: application/json');

		/*$parts = Parts::model()->findAll('status=7');
		foreach ($parts as $key => $part) {
			$part->delete();
		}*/
		if($user_id > 0){
			$data = Yii::app()->db->createCommand()
				->select('p.id, name, DATE_FORMAT(create_time, "%e.%d.%y %H:%i") as create_date, price_sell, price_buy, comment, category_id, car_model_id, location_id, supplier_id, u.used_car_id, status, user_id')
				->from('{{Parts}} as p')
				->leftJoin('{{Parts_UsedCars}} as u', 'p.id=u.parts_id')
				->where('(status=8) AND user_id=:user_id', array(':user_id' => $user_id)) //Reserved for DEVICE
				->order('create_time DESC')
				->queryAll();

			$this->response->data['parts'] = $data;
		}

		$this->printJSON();

		Yii::app()->end();
	}

	public function actionAllParts($user_id){
		
		header('Content-Type: application/json');
		
		if($user_id > 0){
			$data = Yii::app()->db->createCommand()
				->select('p.id, name, create_time, update_time, price_sell, price_buy, comment, category_id, car_model_id, location_id, supplier_id, u.used_car_id, status, user_id')
				->from('{{Parts}} as p')
				->leftJoin('{{Parts_UsedCars}} as u', 'p.id=u.parts_id')
				->where('(status=7 OR status=8) AND user_id=:user_id', array(':user_id' => $user_id)) //DEVICE
				->order('create_time DESC')
				->queryAll();
			$this->response->data['parts'] = $data;
		}
		$this->printJSON();
		
		Yii::app()->end();
	}

	private function printJSON(){
		echo CJSON::encode($this->response);
	}
}