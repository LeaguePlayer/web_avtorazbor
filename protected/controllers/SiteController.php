<?php

class SiteController extends FrontController
{
	public $layout = '//layouts/simple';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js', CClientScript::POS_END);
		//данные для списоков 
		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		$Bascet=UsedCars::getBasketList();
		$Transmission=UsedCarInfo::transmissionList();
		$State=UsedCarInfo::statesList();


		//дата провайдер для каруселей

		$criteriaNews=new CDbCriteria;
		$criteriaNews->order='create_time desc';

		$currentYear=date('Y');

		$criteriaNews->
			addCondition("DATE_FORMAT(`create_time`,'%Y-%m-%d')<='".$currentYear."-12-31' and DATE_FORMAT(`create_time`,'%Y-%m-%d')>='".$currentYear."-01-01'");

		$dataProviderNews=new CActiveDataProvider('News', array(
			'criteria' => $criteriaNews,
			'pagination'=>false
		));
	
		////////////////


		$criteriaCar=new CDbCriteria;
		$criteriaCar->order='id desc';


		$dataProviderCar=new CActiveDataProvider('UsedCars', array(
			'criteria' => $criteriaCar,
			'pagination'=>false
		));

		$this->render('index',
			array(
				'Brands'=>$Brands,
				'Bascet'=>$Bascet,
				'Transmission'=>$Transmission,
				'State'=>$State,
				'dataProviderNews'=>$dataProviderNews,
				'dataProviderCar'=>$dataProviderCar,
			)
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}