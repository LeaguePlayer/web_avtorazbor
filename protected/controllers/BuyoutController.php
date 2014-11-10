<?php

class BuyoutController extends FrontController
{
	public $layout='//layouts/simple';
	public $modelName="Выкуп автомобилей";
	
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
			'model'=>$this->loadModel('Buyout', $id),
		));
	}
	
	public function actionIndex()
	{
		$model=new Buyout;
		if (isset($_POST['Buyout']))
		{
			$model->attributes=$_POST['Buyout'];
			$valid=$model->validate();
			if ($valid)
			{
				$model->save();
				$this->redirect(array('/page/thanks'));
			}
		}
		
		$this->render('index',array('model'=>$model));
	}
}
