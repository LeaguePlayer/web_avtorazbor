<?php

class DiagnosticController extends FrontController
{
	public $layout='//layouts/content';
	public $viewTitle="";
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionView($alias)
	{
		$model=Diagnostic::model()->published()->find('alias=:alias',array(':alias'=>$alias));
		$this->viewTitle=$model->title;
		$this->render('view',array('model'=>$model));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Diagnostic');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
