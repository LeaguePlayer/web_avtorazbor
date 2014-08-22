<?php

class CatalogController extends FrontController
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
				'actions'=>array('index','view','getCars','Car'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		if(!Yii::app()->request->isAjaxRequest)
		{
			$session=Yii::app()->session;
			unset($session["backToResultUrl"]);

			$cs = Yii::app()->clientScript;
			// $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.ui-slider.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);

			$searchForm=new SearchFormOnMain;
			if (isset($_GET['SearchFormOnMain']))
			{
				$searchForm->attributes=$_GET['SearchFormOnMain'];
			}

			$searchForm->validate();

			$dataProvider=new CActiveDataProvider('UsedCars', array(
				'criteria' => $searchForm->criteria,
				'pagination'=>array(
			        'pageSize'=>$searchForm->display,
			    ),
			));

			$Countries=CHtml::listData(Country::model()->findAll(),'id','name');
			$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
			$Bascet=UsedCars::getBasketList();
			$Models=array();
			Yii::app()->session['returnUrl']=$_GET['SearchFormOnMain'];
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'Countries'=>$Countries,
				'Transmission'=>UsedCarInfo::transmissionList(),
				'Brands'=>$Brands,
				'Bascet'=>$Bascet,
				'brand_id'=>$brand_id,
				'Models'=>$Models,
				'searchForm'=>$searchForm

			));
		} else {
			$this->getCars();
		}
		
	}

	public function GetCars()
	{
		$searchForm=new SearchFormOnMain;
		
		if (isset($_GET['SearchFormOnMain']))
		{
			$searchForm->attributes=$_GET['SearchFormOnMain'];
			Yii::app()->session['BackToSearchUrl']=$_GET['SearchFormOnMain'];
		}
		
		$searchForm->validate();
		$dataProvider=new CActiveDataProvider('UsedCars', array(
			'criteria' => $searchForm->criteria,
			'pagination'=>array(
		        'pageSize'=>$searchForm->display,
		    ),
		));

		$dataProvider=new CActiveDataProvider('UsedCars', array(
			'criteria' => $searchForm->criteria,
			'pagination'=>array(
		        'pageSize'=>$searchForm->display,
		    ),
		));

		echo $this->renderPartial('//catalog/tabView',array('dataProvider'=>$dataProvider),true);
	}

	public function actionCar($id)
	{

		$cs = Yii::app()->clientScript;
		
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js', CClientScript::POS_END);

		$model=UsedCars::model()->find('id=:id',array(':id'=>$id));

		$this->render('view',array('model'=>$model));
	}

}

