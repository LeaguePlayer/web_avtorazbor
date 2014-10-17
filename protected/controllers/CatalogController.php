<?php

class CatalogController extends FrontController
{
	public $layout = '//layouts/simple';
	public $modelName="Каталог автомобилей";
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

			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);

			$searchForm=new Search;

			if (isset($_GET['Search']))
			{
				$searchForm->attributes=$_GET['Search'];
			}

			$searchForm->validate();

			$dataProvider=new CActiveDataProvider('UsedCars', array(
				'criteria' => $searchForm->criteria,
				'pagination'=>array(
			        'pageSize'=>$searchForm->display,
			    ),
			));

			$countriCriteria=UsedCars::getExistsData(null,null,'id_country');

			$Countries=CHtml::listData(Country::model()->findAll($countriCriteria),'id','name');
			$Brands=CHtml::listData(CarBrands::model()->findAll('id_country=:id',array(':id'=>$searchForm->id_country ? $searchForm->id_country : 0)),'id','name');
			$Bascet=UsedCars::getBasketList();
			$Models=CHtml::listData(CarModels::model()->findAll('brand=:id',array(':id'=>$searchForm->brand ? $searchForm->brand : 0)),'id','name');

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
		$searchForm=new Search;
		
		if (isset($_GET['Search']))
		{
			$searchForm->attributes=$_GET['Search'];
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

