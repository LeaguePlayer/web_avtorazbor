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
				$this->checkUtilization();

				//reserv parts
				foreach ($request->parts as $part) {
					$part->status = Parts::STATUS_RESERVED;
					$part->update(array('status'));
				}

				$request->status = Requests::STATUS_PARTS_RESERVED;
				$request->save(false);

				//set cron task
				$this->addCronTask($request);

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
				$this->checkUtilization();

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
	 * Delete request action
	 */
	public function actionDelete($id){
		$model = Requests::model()->findByPk($id);

		if(!$model) 
			throw new CHttpException(404, 'Данные не найдены');

		$model->delete();
	}

	/**
	 * Action for Utilization parts STEP 4
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

	/*public function actionGetParts(){
		header('Content-type: application/json');

		// $model = Requests::model()->findByPk($id);

		echo CJSON::encode(Parts::model()->findByPk(1));

		Yii::app()->end();
	}*/

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
		$cron = new Crontab('cron_requests'); // my_crontab file will store all added jobs

		$request->deleteTaskFromCron();
		//$cron->eraseJobs();

		// Осуществим проход массива и выведем содержимое в виде HTML-кода вместе с номерами строк.
		// foreach ($lines as $line) {
		// 	var_dump($line);
		// 	var_dump(strpos($line, '--id='.$request->id));
		// 	if(strpos($line, '--id='.$request->id) !== false)
		//     	echo "Строка : " . htmlspecialchars($line) . "<br />\n";
		// }

		//print_r($tmp);
		// die();
		
		/*$jobs_obj = $cron->getJobs(); // previous jobs saved in my_crontab

		foreach($jobs_obj as $job)
			echo $job->getCommand();

		$cron->eraseJobs(); // erase all previous jobs in my_crontab*/

		$now = new DateTime('NOW', new DateTimeZone('Asia/Yekaterinburg'));

		$request_time = Settings::getValue('request_time') ? Settings::getValue('request_time') : 24;
		$now->modify( '+'.$request_time.' hour' );

		// Application console job
		$cron->addApplicationJob('protected/yiic', 'request broken --id='.$request->id, array(), $now->format('i'), $now->format('G'), $now->format('j'), $now->format('n'));
		// $cron->addApplicationJob('protected/yiic', 'request broken --id='.$request->id, array(), '28', '14', $now->format('j'), $now->format('n'));

		// to change job values:
		/*$jobs_obj = $cron->getJobs();
		$jobs_obj[0]->setParams(array("'datetime'"));
		$jobs_obj[0]->setCommandName('test');

		// <= adds a job with: * * * * * php /home/user/my_project/www/yiicmd.php test 'datetime'

		// add an other job
		$job = new CronApplicationJob('yiicmd', 'test', array("'datetime"), '0', '0'); // run every day
		$job->setParams(array("'date'"));
		$cron->add($job);

		// <= adds a second job with: 0 0 * * * php /home/user/my_project/www/yiicmd.php test 'date'

		// add a regular cron job
		$cron->addJob('/home/user/myprogram.bin', '0', '0', '*', '*', '1'); // run every monday
		$jobs_obj = $cron->getJobs();
		echo $jobs_obj[2]->getCommand();
		*/
		// <= adds a third job with: 0 0 * * 1 /home/user/myprogram.bin 

		//$cron->removeJob(2); // removes job with offset 2 (last added here)

		$cron->saveCronFile(); // save to my_crontab cronfile

		$cron->saveToCrontab(); // adds all my_crontab jobs to system (replacing previous my_crontab jobs)
	}

	private function checkUtilization(){
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
