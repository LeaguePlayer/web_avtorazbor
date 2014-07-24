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
			$cs = Yii::app()->clientScript;
			// $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.ui-slider.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/Catalog.js', CClientScript::POS_END);

			$criteria=new CDbCriteria;
			

			$pageSize=$_GET['display'] ? (int)$_GET['display'] : 2;
			$sort=$_GET['sort'] ? $_GET['sort'] : 'price';

			$criteria->order=$sort.' desc';
			$criteria->addCondition('type=1');
			$criteria->addCondition('price<=5000000');
			$criteria->addCondition('`t`.force<=1000');

			if (isset($_GET['brand']))
			{
				$brand_id=CarBrands::model()->find('name=:name',array(':name'=>$_GET['brand']))->id;
				$criteria->join=UsedCars::model()->join();
				if (!empty($brand_id))
					$criteria->addCondition('brand='.$brand_id);

			}
			$dataProvider=new CActiveDataProvider('UsedCars', array(
				'criteria' => $criteria,
				'pagination'=>array(
			        'pageSize'=>$pageSize,
			        'pageVar'=>'page',
			    ),
			));

			$Countries=CHtml::listData(Country::model()->findAll(),'id','name');

			$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');

			$Bascet=UsedCars::getBasketList();

			$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'Countries'=>$Countries,
				'Transmission'=>UsedCarInfo::transmissionList(),
				'Brands'=>$Brands,
				'Bascet'=>$Bascet,
				'brand_id'=>$brand_id,
			));
		} else {
			$this->getCars();
		}
		
	}

	public function GetCars()
	{
		$data=$_GET['data'];

		$criteria=new CDbCriteria;
		$criteria->order=($data['pager']['sort'] ? $data['pager']['sort'] : 'price') .' desc';
		$condition="";
		
		if ($data)
		{
			foreach ($data['conditions'] as $key => $value) {

				if (!empty($value))
				{
					$condition=SiteHelper::getCondition($key,$value);
					if ($condition)
						$criteria->addCondition($condition);
				}
			}
		}

		$pageSize=$data['pager']['display'] ? (int)$data['pager']['display'] : 2;

		$criteria->join=UsedCars::model()->join();
		$criteria->condition=str_replace('force', '`t`.force', $criteria->condition);

		$dataProvider=new CActiveDataProvider('UsedCars', array(
			'criteria' => $criteria,
			'pagination'=>array(
		        'pageSize'=>$pageSize,
		        'pageVar'=>'page',
		    ),
		));

		CJSON::encode($this->renderPartial('//catalog/tabView',array('dataProvider'=>$dataProvider),false,false));
	}

	public function actionCar($id)
	{
		$model=UsedCars::model()->find('id=:id',array(':id'=>$id));
		$this->render('view',array('model'=>$model));
	}

}

