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
}
