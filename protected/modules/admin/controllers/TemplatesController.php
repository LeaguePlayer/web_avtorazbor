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

		if(isset($_POST['Templates'])){
			$model->attributes = $_POST['Templates'];

			$oldFile = $model->file;
			$model->file = CUploadedFile::getInstance($model,'file');


			if(!$model->file)
				$model->file = $oldFile;

			// var_dump($model->file); die();
			if($model->save())
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array('model' => $model));
	}

	public function actionTranslit($str){
		echo CJSON::encode(SiteHelper::translit($str));
	}

	public function actionDeleteFile($id){
		$model = Templates::model()->findByPk($id);

		if(!$model)
			Yii::app()->end(404);

		$model->file='';
		$model->save(false);

		Yii::app()->end(200);
	}

}
