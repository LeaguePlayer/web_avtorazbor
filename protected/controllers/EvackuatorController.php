<?php

class EvackuatorController extends FrontController
{
	public $layout='//layouts/simple';

	
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

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Evackuator', $id),
		));
	}

	
	public function actionIndex()
	{
		$model=new Evackuator;
		
		if (isset($_POST['Evackuator']))
		{
			if ($model->save())
			{
				$this->redirect(array('/page/thanks'));
			}
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
}
