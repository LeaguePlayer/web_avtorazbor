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
	
	public function actionIndex()
	{
		$searchForm=new Search;
		if (!Yii::app()->request->isAjaxRequest)
		{
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js', CClientScript::POS_END);
			$news=new News;
			$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
			$Bascet=UsedCars::getBasketList();
			$Transmission=UsedCarInfo::transmissionList();
			$State=UsedCarInfo::statesList();
			
			$criteriaCar=new CDbCriteria;
			$criteriaCar->join=Parts::join();
			$criteriaCar->addCondition('car_type=1');
			$criteriaCar->addCondition('status=2');
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
					'dataProviderCar'=>$dataProviderCar,
					'searchForm'=>$searchForm,
					'news'=>$news
				)
			);

		} else {
			if (isset($_GET['Search']))
			{
				$searchForm->attributes=$_GET['Search'];
				$searchForm->validate();

				$model=$_GET['Search']['scenario']=='light' || $_GET['Search']['scenario']=='weight' ? 'UsedCars' : 'Parts';

				$searchForm->criteria->limit='50';
				//var_dump($model,$searchForm->criteria->condition,$searchForm->criteria->join);die();
				$dataProvider=new CActiveDataProvider($model,
					array('criteria'=>$searchForm->criteria)
				);
				$this->renderPartial('carCarusel',array('dataProvider'=>$dataProvider));
			}
		}
	}

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