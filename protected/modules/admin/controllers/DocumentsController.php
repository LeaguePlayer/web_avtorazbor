<?php

class DocumentsController extends AdminController
{
	public function actionDownload($file){
		$pathToTemplates = Yii::getPathOfAlias('application.docs');

		SiteHelper::downloadFile($pathToTemplates.DIRECTORY_SEPARATOR.$file);
	}

	/**
	 * Договор комиссии
	 */
	public function actionTest(){

		$bu_car = UsedCars::model()->findByPk(5);
		DocumentBuilder::createDogovorKomissii($bu_car);

		$this->redirect($this->createUrl('list'));
	}

	public function actionSendFile(){

		if(isset($_POST['Email'])){
			if($_POST['Email']['email'] != '' && $_POST['Email']['document_id'] != 0){

				$document = Documents::model()->findByPk($_POST['Email']['document_id']);
				if(!$document) throw new CHttpException(404, 'Документ не найден');

				// print_r('Документ: '.$document->name); die();
				try {
					echo Yii::app()->swiftmail->sendEmail(array('test@test.ru' => 'Test'), $_POST['Email']['email'], $document->getType(), 'Документ: '.$document->name, array($document->getFilePath()));
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

	public function actionCreate(){
		$model = new Documents;
		$client = new Clients;

		if(isset($_POST['Documents'])){
			$model->attributes = $_POST['Documents'];

			$usedCar = UsedCars::model()->findByPk($model->used_car_id);

			$valid = true;

			if(isset($_POST['Clients'])){
				$client->attributes = $_POST['Clients'];
				$client->type = 1; //fizik

				$valid = $valid && $client->validate();
			}

			if($valid && isset($_POST['with_doc_komissii'])){
				$client->save(false);

				$usedCar->buyer_id = $client->id;
				$usedCar->update(array('buyer_id'));
				//create docs
				DocumentBuilder::documentKupliProdBUWithDocKomissii($usedCar); //document save inside function
				$this->redirect($this->createUrl('list'));
			}elseif($valid){
				$client->save(false);

				$usedCar->buyer_id = $client->id;
				$usedCar->update(array('buyer_id'));
				//create docs
				DocumentBuilder::documentKupliProdBUNotDocKomissii($usedCar); //document save inside function
				$this->redirect($this->createUrl('list'));
			}
		}

		$this->render('create', array('model' => $model, 'client' => $client));
	}

	public function actionUpdate($id){
		$model = Documents::model()->findByPk($id);
		$client = Clients::model()->findByPk($model->used_car->buyer->id);
		// print_r($model->type); die();

		if(!$model)
			throw new CHttpException(404, 'Документ не найден');

		if(isset($_POST['Documents'])){
			$model->attributes = $_POST['Documents'];

			$usedCar = UsedCars::model()->findByPk($model->used_car_id);
			$valid = true;

			if(isset($_POST['Clients'])){
				$client->attributes = $_POST['Clients'];

				$valid = $valid && $client->validate();
			}

			if($valid && $model->type == Documents::DOC_KUPLI_I_PROD_BU_WITH_KOMISSII){
				$client->save(false);
				//document save inside function
				DocumentBuilder::documentKupliProdBUWithDocKomissii($usedCar, $model->id); 
				$this->redirect($this->createUrl('list'));
			}elseif($valid && $model->type == Documents::DOC_KUPLI_I_PROD_BU_NO_KOMISSII){
				$client->save(false);
				//create docs
				//document save inside function
				DocumentBuilder::documentKupliProdBUNotDocKomissii($usedCar, $model->id); 
				$this->redirect($this->createUrl('list'));
			}
		}

		if($model->used_car->buyer){
			$this->render('update', array('model' => $model, 'client' => $model->used_car->buyer));
		}
	}
}
