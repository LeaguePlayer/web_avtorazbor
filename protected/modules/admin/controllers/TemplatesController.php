<?php

class TemplatesController extends AdminController
{
	public function actionCreate(){
		$model = new Templates;

		if(isset($_POST['Templates'])){
			$model->attributes = $_POST['Templates'];
			$model->file = CUploadedFile::getInstance($model,'file');

			if($model->save())
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id){
		$model = Templates::model()->findByPk($id);

		//set handler
		$model->onChangeFile = array($this, 'changeDoc');

		if(isset($_POST['Templates'])){
			$model->attributes = $_POST['Templates'];

			$oldFile = $model->file;
			$model->file = CUploadedFile::getInstance($model,'file');

			if(!$model->file)
				$model->file = $oldFile;

			if($model->save())
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array('model' => $model));
	}

	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
		Yii::app()->end();
	}

	public function actionDeleteFile($id){
		$model = Templates::model()->findByPk($id);

		if(!$model)
			Yii::app()->end(404);

		$model->removeTemplateFile();
		$model->file='';
		$model->save(false);

		Yii::app()->end(200);
	}

	public function actionDownload($file){
		$pathToTemplates = Yii::getPathOfAlias('application.docs.templates');

		SiteHelper::downloadFile($pathToTemplates.DIRECTORY_SEPARATOR.$file);
	}

	//handler for Temmplate change
	public function changeDoc($event){
		Yii::import('admin.controllers.DocumentsController');

		$template = $event->sender;
		foreach ($template->docs as $doc) {
			if($doc->type == Documents::DOC_KOMISSII){
				if($doc->used_car){
					DocumentBuilder::createDogovorKomissii($doc->used_car, $doc->id);
				}
			}
		}
	}
}
