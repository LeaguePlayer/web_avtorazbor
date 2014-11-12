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
				'actions'=>array('index','view','nestedList'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetModels(){

		

	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Evackuator', $id),
		));
	}

	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
			$cs->registerScriptFile($this->getAssetsUrl().'/js/evacuator.js?v=1', CClientScript::POS_END);

		$model=new Evackuator;
		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		if (isset($_POST['Evackuator']))
		{
			$model->attributes=$_POST['Evackuator'];
			$model->status=0;
			
			if ($model->save())
			{
				$this->redirect(array('/page/thanks'));
			}

		}

		$this->render('index',array(
			'model'=>$model,
			'Brands'=>$Brands,
		));
	}
}
