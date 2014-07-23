<?php

class DetailController extends FrontController
{
	public $layout = '//layouts/simple';
	
	/**
	 * Declares class-based actions.
	 */
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

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
				'actions'=>array('index','view','getcars'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
	}
	
	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		$this->render('index');
	}

	public function actionView($id)
	{
		$model=News::model()->find('id=:id',array(':id'=>$id));
		$this->render('view',array('model'=>$model));	
	}

	public function actionGetCars()
	{
		
	}

	public function getDetails($params = array())
	{
		if (!empty($params))
		{
			foreach($params['conditions'] as $key=>$value)
			{
				if (!empty($value))
				{

				}
			}
		}
	}
	
}
