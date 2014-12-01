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
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js?v=2', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js?v=2', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);
			$this->title="Каталог Автомобилей";
			Yii::app()->clientScript->registerMetaTag($this->title, 'title', null, array('id'=>'meta_title'), 'meta_title');

			$searchForm=new Search;

			if (isset($_GET['Search']))
			{
				$searchForm->attributes=$_GET['Search'];
			}

			$searchForm->validate();
			//var_dump($searchForm->criteria->condition);die();
			$dataProvider=new CActiveDataProvider('UsedCars', array(
				'criteria' => $searchForm->criteria,
				'pagination'=>array(
			        'pageSize'=>$searchForm->display,
			    ),
			));


			$Countries=CHtml::listData(Country::model()->findAll(UsedCars::getExistsData(null,null,'id_country')),'id','name');
			$WeightCountries=CHtml::listData(Country::model()->findAll(UsedCars::getExistsData(null,null,'id_country',2)),'id','name');
			$Brands=UsedCars::getExistsData($searchForm->id_country,'id_country','brand');
			$Brands=CHtml::listData(CarBrands::model()->findAll($Brands),'id','name');

			$WeightBrands=UsedCars::getExistsData($searchForm->id_country,'id_country','brand',2);
			$WeightBrands=CHtml::listData(CarBrands::model()->findAll($WeightBrands),'id','name');
			
			$Bascet=UsedCars::getBasketList();

			$Models=UsedCars::getExistsData($searchForm->brand,'brand','car_model_id');
			$Models=CHtml::listData(CarModels::model()->findAll($Models),'id','name');

			$WeightBascet=UsedCars::getWeightBasketList();
			
			$WeightModels=CHtml::listData(CarModels::model()->findAll('brand=:id',array(':id'=>$searchForm->brand && $searchForm->scenario=='WeightModels' ? $searchForm->brand : 0)),'id','name');
			$State=UsedCarInfo::statesList();
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'Countries'=>$Countries,
				'Transmission'=>UsedCarInfo::transmissionList(),
				'Brands'=>$Brands,
				'Bascet'=>$Bascet,
				'State'=>$State,
				'brand_id'=>$brand_id,
				'WeightBrands'=>$WeightBrands,
				'WeightCountries'=>$WeightCountries,
				'WeightModels'=>$WeightModels,
				'WeightBascet'=>$WeightBascet,
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

	public function actionCar($alias)
	{
		$cs = Yii::app()->clientScript;
		
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js?v=1', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js?v=3', CClientScript::POS_END);

		$model=UsedCars::model()->find('alias=:alias',array(':alias'=>$alias));
		if (!$model || $model->status!=2)
		{
			throw new CHttpException("По вашему запросу не было найдено данных", 404);
			die();
		}
		$this->title=$model->model->car_brand->name.'/'.$model->model->name;
		Yii::app()->clientScript->registerMetaTag($this->title, 'title', null, array('id'=>'meta_title'), 'meta_title');
		
		$ownPrice=new Ownprice;
		$ownPrice->car_id=$id;
		$this->render('view',array('model'=>$model,'ownPrice'=>$ownPrice));
	}
}

