<?php

class PageController extends FrontController
{
	public $layout='//layouts/simple';
	public $alias=null;
	
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
				'actions'=>array('index','view','service'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionView($alias)
	{

		$model=Page::model()->find('alias=:alias',array(':alias'=>$alias));
		$this->alias=$model->alias;
		if (!$model)
			throw new CHttpException(404,'По вашему запросу не было найдено данных.');
		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionService()
	{
		$cs = Yii::app()->clientScript;
		$this->alias='service';
		$cs->registerScriptFile($this->getAssetsUrl().'/js/pageService.js', CClientScript::POS_END);
		$this->render('service',array('news'=>new News));
	}
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
