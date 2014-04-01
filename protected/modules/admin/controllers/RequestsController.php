<?php

class RequestsController extends AdminController
{
	public $layout = '/layouts/custom';

	public function actionCreate(){
		$model = new Requests;

		$model->from = Requests::FROM_ADMIN;
		$model->user_id = Yii::app()->user->id;
		$model->status = Requests::STATUS_PUBLISH;

		//log attributes
        //$model->compareNewAndOldAttributes();

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

		if($request->status == Requests::STATUS_PARTS_RESERVED){
			$this->redirect($this->createUrl('step2', array('id' => $request->id)));
		}elseif($request->status == Requests::STATUS_WAIT_BUY){
			$this->redirect($this->createUrl('step3', array('id' => $request->id)));
		}

		$this->redirect($this->createUrl('step1', array('id' => $request->id)));
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
				// print_r($_POST['Requests']); die();
				// $this->checkUtilization($request);

				//log attributes

				//reserv parts
				foreach ($request->parts as $part) {
					$part->status = Parts::STATUS_RESERVED;
					$part->update(array('status'));
				}

				$request->status = Requests::STATUS_PARTS_RESERVED;

				//$request->compareNewAndOldAttributes(); die();

				$request->save(false);

				//set cron task
				$this->addCronTask($request);

				$this->redirect($this->createUrl('step2', array('id' => $request->id)));
			}
		}

		if(!$request->date_life){
			$date = new DateTime('NOW');
			$date->modify('+1 day');
			$request->date_life = $date->format('d.m.Y H:i');
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
				$this->checkUtilization($request);

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
			$request->status = Requests::STATUS_SUCCESS;
			$request->update(array('status'));

			if($request->parts_in_util){
				$this->redirect($this->createUrl('utilization', array('id' => $request->id)));
			}

			$this->redirect($this->createUrl('list'));
		}

		$this->render('step3/update', array('model' => $request));
	}


	/**
	 * Delete request action
	 */
	public function actionDelete($id){
		$model = Requests::model()->findByPk($id);

		if(!$model) 
			throw new CHttpException(404, 'Данные не найдены');

		$model->delete();
	}

	public function actionView($id){
		$model = Requests::model()->findByPk($id);
		$requestLog = new RequestLogs;
		$requestSave = new RequestLogs;

		if(!$model) 
			throw new CHttpException(404);

		//save message
		if(isset($_POST['RequestLogs'])){
			$requestSave->attributes = $_POST['RequestLogs'];

			$requestSave->user_id = Yii::app()->user->id;
			$requestSave->request_id = $model->id;

			if($requestSave->save())
				$this->redirect($this->createUrl('view', array('id' => $model->id)));
		}

		$criteria = new CDbCriteria;

		$criteria->addCondition('request_id=:r');
		$criteria->params[':r'] = $model->id;

		// $criteria->join = 'LEFT JOIN {{users}} AS u ON u.id=user_id';
		// $criteria->order = 'create_time DESC';

		//filter
		if(isset($_GET['RequestLogs'])){
			$requestLog->attributes = $_GET['RequestLogs'];

			$criteria->compare('message', $requestLog->message, true);
			$criteria->compare('type', $requestLog->type);
		}

		$dataProvider = new CActiveDataProvider('RequestLogs', array(
            'criteria'=>$criteria,
        ));

		$this->render('view', array(
			'model' => $model, 
			'dataProvider' => $dataProvider,
			'requestLog' => $requestLog,
			'requestSave' => $requestSave
		));
	}

	/**
	 * Action for Utilization parts STEP 4
	 */
	
	public function actionUtilization($id){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Заявка не найдена!');

		if(isset($_POST['Parts']) && !empty($_POST['Parts'])){
			foreach ($_POST['Parts'] as $part) {
				if(isset($part['checked'])){
					$part_model = Parts::model()->findByPk($part['id']);

					$part_model->status = Parts::STATUS_UTIL;
					$part_model->comment = $part['comment'];

					$part_model->update(array('status', 'comment'));
				}
			}
			Yii::app()->db->createCommand()->delete('{{CheckUtilization}}', 'req_id=:r_id', array(':r_id' => $request->id));
			$this->redirect($this->createUrl('list'));
		}

		$this->render('utilization', array('parts' => $request->parts_in_util));
		//$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function actionAddPart($request_id, $part_id, $step = 1){
		
		$model = Requests::model()->findByPk($request_id);
		$part = Parts::model()->findByPk($part_id);

		if(!$model || !$part)
			throw new CHttpException(404, 'Данные не найдены');

		$dbCommand = Yii::app()->db->createCommand();

		$dbCommand->insert('{{PartsInRequest}}',array(
			'request_id' => $request_id,
			'part_id' => $part_id
		));

		if($step == 2){ //сразу на резерв
			$part->status = Parts::STATUS_RESERVED;
			$part->update(array('status'));
		}

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


	/**
	 * Change price Part
	 */
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

	/**
	 * Cancel Request
	 */
	public function actionCancel($id){

		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Данные не найдены');

		$request->cancel();

		$this->redirect($this->createUrl('list'));
	}

	/**
	 * Change status Request
	 */
	public function actionChange($id, $status){
		$request = Requests::model()->findByPk($id);

		if(!$request)
			throw new CHttpException(404, 'Данные не найдены');

		if($status == Requests::STATUS_PUBLISH) $request->publish();
		elseif($status == Requests::STATUS_CANCELED) $request->cancel();

		Yii::app()->end();
	}

	/**
	 * Add Cron task for unactive Request
	 */
	private function addCronTask($request){
		$cron = new Crontab('cron_requests');

		$request->deleteTaskFromCron();

		$date = \DateTime::createFromFormat('Y-m-d H:i:s', $request->date_life);

		$cron->addApplicationJob('protected/yiic', 'request broken --id='.$request->id, array(), $date->format('i'), $date->format('G'), $date->format('j'), $date->format('n'));

		$cron->saveCronFile();
		$cron->saveToCrontab();
	}

	private function checkUtilization($request){
		if(isset($_POST['Utilization'])){ //Есть детали на утилизацию
			//записываем во временную таблицу запчасти которые могут попасть в утилизацию
			foreach ($_POST['Utilization'] as $util_part_id) {
				Yii::app()->db->createCommand()->insert('{{CheckUtilization}}',array(
					'req_id' => $request->id,
					'part_id' => $util_part_id
				));
			}
		}
	}
}
