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
				'actions'=>array('index','view','getCars'),
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
			

			$pageSize=$_GET['display'] ? (int)$_GET['display'] : 1;
			$sort=$_GET['sort'] ? $_GET['sort'] : 'price';

			$criteria->order=$sort.' desc';
			$criteria->addCondition('type=1');

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
				'Bascet'=>$Bascet
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

		$criteria->join=UsedCars::model()->join();
		$criteria->condition=str_replace('force', '`t`.force', $criteria->condition);
		$dataProvider=new CActiveDataProvider('UsedCars', array(
			'criteria' => $criteria,
			'pagination'=>array(
		        'pageSize'=>Yii::app()->request->getQuery('size', $data['pager']['display']),
		        'pageVar'=>'page',
		    ),
		));
		
		CJSON::encode($this->renderPartial('//catalog/tabView',array('dataProvider'=>$dataProvider),false,false));
	}

	public function actionView($id)
	{
		$model=News::model()->find('id=:id',array(':id'=>$id));
		$this->render('view',array('model'=>$model));	
	}

}

