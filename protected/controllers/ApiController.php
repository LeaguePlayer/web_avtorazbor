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
		$part->status = Parts::STATUS_DEVICE;

		if($part->save()){
			$this->response->data['id'] = (int) $part->id;
		}else{
			$this->response->errors[] = 'Невозможно создать запчасть.';
		}
		$this->printJSON();
		
		Yii::app()->end();
	}

	public function actionAuth(){
		header('Content-Type: application/json');

		Yii::import('user.components.*');
		Yii::import('user.models.*');

		// if(true){
		// 	$identity=new UserIdentity('admin', 'admin1234');
		// 	$identity->authenticate();

		if(isset($_POST['username']) && isset($_POST['pass'])){
			$identity=new UserIdentity($_POST['username'], $_POST['pass']);
			$identity->authenticate();

			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$user = User::model()->findByPk($identity->getId());

					$user_info = new stdClass();
					$user_info->id = $user->id;
					$user_info->fio = $user->profile->first_name." ".$user->profile->last_name;

					$this->response->data['user'] = $user_info;
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

	private function printJSON(){
		echo CJSON::encode($this->response);
	}
}