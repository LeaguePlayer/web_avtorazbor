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

	public function actionSendFile($id){
		$document = Documents::model()->findByPk($id);

		if(!$document) throw new CHttpException(404, 'Документ не найден');

		echo Yii::app()->swiftmail->sendEmail('test@test.ru', 'vetalgal@yandex.ru', $document->getType(), 'Документ: '.$document->name, array($document->getFilePath()));

		Yii::app()->end(200);
	}
}
