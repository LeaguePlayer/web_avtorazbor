<?php

class RequestsController extends AdminController
{
	public function actionCreate(){
		$model = new Requests;

		$model->from = Requests::FROM_ADMIN;
		$model->user_id = Yii::app()->user->id;
		$model->status = Requests::STATUS_PUBLISH;

		$model->save(false);

		$this->redirect($this->createUrl('step1', array('id' => $model->id)));
	}

	/**
	 * Раскидывает по шагам
	 */
	public function actionUpdate($id){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена!');

		switch ($request->status) {
			case Requests::STATUS_PUBLISH:
				$this->redirect($this->createUrl('step1', array('id' => $request->id)));
				break;

			case Requests::STATUS_PARTS_RESERVED:
				$this->redirect($this->createUrl('step2', array('id' => $request->id)));
				break;

			case Requests::STATUS_WAIT_BUY:
				$this->redirect($this->createUrl('step3', array('id' => $request->id)));
				break;
		}		
	}

	/**
	 * STEP 1 REQUEST
	 */
	public function actionStep1($id){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена!');

		if(isset($_POST['Requests'])){
			$request->attributes = $_POST['Requests'];

			if($request->validate()){
				if(isset($_POST['Utilization'])){ //Есть детали на утилизацию

					//записываем во временную таблицу запчасти которые могут попасть в утилизацию
					foreach ($_POST['Utilization'] as $util_part_id) {
						Yii::app()->db->createCommand()->insert('{{CheckUtilization}}',array(
							'req_id' => $request->id,
							'part_id' => $util_part_id
						));
					}
				}

				//reserv parts
				foreach ($request->parts as $part) {
					$part->status = Parts::STATUS_RESERVED;
					$part->update(array('status'));
				}

				$request->status = Requests::STATUS_PARTS_RESERVED;
				$request->save(false);

				$this->redirect($this->createUrl('step2', array('id' => $request->id)));
			}
		}

		$this->render('step1/update', array('model' => $request));
	}

	/**
	 * STEP 2 REQUEST
	 */
	public function actionStep2($id){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена!');

		if(isset($_POST['Requests'])){
			$request->attributes = $_POST['Requests'];

			if($request->validate()){
				if(isset($_POST['Utilization'])){ //Есть детали на утилизацию

					//записываем во временную таблицу запчасти которые могут попасть в утилизацию
					foreach ($_POST['Utilization'] as $util_part_id) {
						Yii::app()->db->createCommand()->insert('{{CheckUtilization}}',array(
							'req_id' => $request->id,
							'part_id' => $util_part_id
						));
					}
				}

				$request->status = Requests::STATUS_WAIT_BUY;
				$request->save(false);

				$this->redirect($this->createUrl('step3', array('id' => $request->id)));
			}
		}

		$this->render('step2/update', array('model' => $request));
	}

	/**
	 * STEP 3 REQUEST
	 */
	public function actionStep3($id){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена!');

		if(isset($_POST['Requests'])){
			$request->attributes = $_POST['Requests'];

			if($request->validate()){

				$request->status = Requests::STATUS_WAIT_BUY;
				$request->save(false);

				//$this->redirect($this->createUrl('step3', array('id' => $request->id)));
			}
		}

		$this->render('step3/update', array('model' => $request));
	}


	/**
	 * Delete action
	 */
	public function actionDelete($id){
		$model = Requests::model()->findByPk($id);

		if(!$model) 
			throw new CHttpException(404, 'Данные не найдены');

		foreach ($model->parts as $part) {
			if($part->status == Parts::STATUS_RESERVED){
				$part->status = Parts::STATUS_PUBLISH;
				$part->update(array('status'));
			}
		}

		$dbCommand = Yii::app()->db->createCommand();

		$dbCommand->delete('{{PartsInRequest}}', 'request_id=:r_id', array(':r_id' => $model->id));
		$dbCommand->delete('{{CheckUtilization}}', 'req_id=:r_id', array(':r_id' => $model->id));

		$model->delete();

	}

	/**
	 * Action for Utilization parts
	 */
	
	public function actionUtilization(){

		if(isset($_POST['Parts']) && !empty($_POST['Parts'])){
			foreach ($_POST['Parts'] as $part) {
				if(isset($part['checked'])){
					$part_model = Parts::model()->findByPk($part['id']);

					$part_model->status = Parts::STATUS_UTIL;
					$part_model->comment = $part['comment'];

					$part_model->update(array('status', 'comment'));
				}
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function actionGetParts(){
		header('Content-type: application/json');

		// $model = Requests::model()->findByPk($id);

		echo CJSON::encode(Parts::model()->findByPk(1));

		Yii::app()->end();
	}

	public function actionAddPart($request_id, $part_id){
		
		$model = Requests::model()->findByPk($request_id);
		$part = Parts::model()->findByPk($part_id);

		if(!$model || !$part)
			throw new CHttpException(404, 'Данные не найдены');

		$dbCommand = Yii::app()->db->createCommand();

		$dbCommand->insert('{{PartsInRequest}}',array(
			'request_id' => $request_id,
			'part_id' => $part_id
		));

		/*$part->status = Parts::STATUS_RESERVED;
		$part->update(array('status'));*/

		$this->renderPartial('step1/_body_parts', array('model' => $model));

		Yii::app()->end();
	}

	public function actionDeletePart($request_id, $part_id){

		$model = Requests::model()->findByPk($request_id);
		$part = Parts::model()->findByPk($part_id);

		if(!$model || !$part)
			throw new CHttpException(404, 'Данные не найдены');

		$dbCommand = Yii::app()->db->createCommand();

		$dbCommand->delete('{{PartsInRequest}}', 'request_id=:r_id AND part_id=:p_id', array(
			':r_id' => $request_id,
			':p_id' => $part_id
		));

		$part->status = Parts::STATUS_PUBLISH;
		$part->update(array('status'));

		$this->renderPartial('step1/_body_parts', array('model' => $model));

		Yii::app()->end();
	}

	public function actionChangePrice($request_id, $part_id, $price){
		$model = Requests::model()->findByPk($request_id);
		$part = Parts::model()->findByPk($part_id);

		if(!$model || !$part)
			throw new CHttpException(404, 'Данные не найдены');

		$dbCommand = Yii::app()->db->createCommand();

		$part->price_sell = $price;
		$part->update(array('price_sell'));

		$this->renderPartial('step1/_body_parts', array('model' => $model));

		Yii::app()->end();
	}

	public function actionCancel($id){

		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Данные не найдены');

		foreach ($request->parts as $part) {
			$part->status = Parts::STATUS_PUBLISH;
			$part->update(array('status'));
		}

		$request->status = Requests::STATUS_CANCELED;
		$request->update(array('status'));

		$this->redirect($this->createUrl('list'));
	}

	public function actionChange($id, $status){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Данные не найдены');

		if($status == Requests::STATUS_PUBLISH){

			foreach ($request->parts as $part) {
				$part->status = Parts::STATUS_PUBLISH;
				$part->update(array('status'));
			}

			$request->status = Requests::STATUS_PUBLISH;
			$request->update(array('status'));

		}elseif($status == Requests::STATUS_CANCELED){
			foreach ($request->parts as $part) {
				$part->status = Parts::STATUS_PUBLISH;
				$part->update(array('status'));
			}

			$request->status = Requests::STATUS_CANCELED;
			$request->update(array('status'));
		}

		Yii::app()->end();
	}
}
