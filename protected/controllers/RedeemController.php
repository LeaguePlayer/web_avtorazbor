<?php

class RedeemController extends FrontController
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
			'model'=>$this->loadModel('Redeem', $id),
		));
	}

	
	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/redeem.js?v=1', CClientScript::POS_END);

		$model=new Redeem;
		
		if (isset($_POST['Redeem']))
		{
			$model->attributes=$_POST['Redeem'];
			if ($model->save())
				$this->redirect(array('/page/thanks'));
		}

		$this->render('index',array('model'=>$model));
	}
}
