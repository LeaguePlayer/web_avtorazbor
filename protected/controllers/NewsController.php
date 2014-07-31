<?php

class NewsController extends FrontController
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
			'model'=>$this->loadModel('News', $id),
		));
	}

	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/tabNews.js', CClientScript::POS_END);

		$criteriaCruYear=new CDbCriteria;
		$criteriaCruYear->order='create_time desc';

		$criteriaPrevYear=new CDbCriteria;
		$criteriaPrevYear->order='create_time desc';

		$currentYear=date('Y');
		$prevYear=date('Y')-1;

		$criteriaCruYear->
			addCondition("DATE_FORMAT(`create_time`,'%Y-%m-%d')<='".$currentYear."-12-31' and DATE_FORMAT(`create_time`,'%Y-%m-%d')>='".$currentYear."-01-01'");

		$dataProviderCurYear=new CActiveDataProvider('News', array(
			'criteria' => $criteriaCruYear,
			'pagination'=>array(
		        'pageSize'=>3,
		        'pageVar'=>'page',
		    ),
		));

		
		
		$criteriaPrevYear->
			addCondition("DATE_FORMAT(`create_time`,'%Y-%m-%d')<='".$prevYear."-12-31' and DATE_FORMAT(`create_time`,'%Y-%m-%d')>='".$prevYear."-01-01'");

		$dataProviderPrevYear=new CActiveDataProvider('News', array(
			'criteria' => $criteriaPrevYear,
			'pagination'=>array(
		        'pageSize'=>3,
		        'pageVar'=>'page',
		    ),
		));

		$this->render('index',array(
			'dataProviderCurYear'=>$dataProviderCurYear,
			'dataProviderPrevYear'=>$dataProviderPrevYear,
		));
	}

	public function getNews(){

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/tabNews.js', CClientScript::POS_END);

		$criteria=new CDbCriteria;
		$criteria->order='create_time desc';
		
		$dataProvider=new CActiveDataProvider('News', array(
			'criteria' => $criteria,
			'pagination'=>array(
		        'pageSize'=>Yii::app()->request->getQuery('size', 1),
		        'pageVar'=>'page',
		    ),
		));

	}
}
