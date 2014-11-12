<?php

class NewsController extends FrontController
{
	public $layout='//layouts/simple';
	public $modelName="Новоcти";


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
	
	// public function actionView($alias)
	// {
	// 	$model=News::model()->find('alias=:alias',array(':alias'=>$alias));
	// 	$this->model=$model;

	// 	$this->render('view',array('model'=>$model));
	// }

	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/tabNews.js?v=1', CClientScript::POS_END);

		$criteriaCars=new CDbCriteria;
		$criteriaCars->order="id desc";
		$criteriaCars->limit="20";
		$criteriaCars->addCondition('status=2');
		
		$criteriaRazbor=new CDbCriteria;
		$criteriaRazbor->limit="20";
		$criteriaRazbor->order="id desc";
		$criteriaRazbor->addCondition('status=1');

		$razbor=new CActiveDataProvider('UsedCars',array(
				'criteria'=>$criteriaRazbor,

			)
		);
		$cars=new CActiveDataProvider('UsedCars',array(
				'criteria'=>$criteriaCars,
			)
		);
		$this->render('index',array('razbor'=>$razbor,'cars'=>$cars));
	}

	// public function getNews(){

	// 	$cs = Yii::app()->clientScript;
	// 	$cs->registerScriptFile($this->getAssetsUrl().'/js/tabNews.js', CClientScript::POS_END);

	// 	$criteria=new CDbCriteria;
	// 	$criteria->order='create_time desc';
		
	// 	$dataProvider=new CActiveDataProvider('News', array(
	// 		'criteria' => $criteria,
	// 		'pagination'=>array(
	// 	        'pageSize'=>Yii::app()->request->getQuery('size', 1),
	// 	        'pageVar'=>'page',
	// 	    ),
	// 	));

	// }
}
