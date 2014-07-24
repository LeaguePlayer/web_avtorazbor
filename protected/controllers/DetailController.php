<?php

class DetailController extends FrontController
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
				'actions'=>array('index','view','parts'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
	}
	
	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		// $cs->registerScriptFile($this->getAssetsUrl().'/js/tinyscrollbar.js', CClientScript::POS_END);
		// $cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		if(!Yii::app()->request->isAjaxRequest)
		{

			$Brand=CHtml::listData(CarBrands::model()->findAll(),'id','name');
			$this->render('index',array('Brand'=>$Brand));
		}

	}
	public function actionParts()
	{
		$criteria=new CDbCriteria;
		$criteria->order='id desc';

		$params=array ( 'carBrands' => 'brand', 'CarModels' => 'car_model_id', 'Category'=>'category_id', 'subCategories' => 'parent');

		$joins=array ( 
				'CarModels' => 'LEFT JOIN  `tbl_carmodels` ON  `t`.car_model_id =  `tbl_carmodels`.id ',
				'Categories' => 'LEFT JOIN  `tbl_categories` ON  `t`.category_id =  `tbl_categories`.id ',
			 	'carBrands' => 'LEFT JOIN  `tbl_carbrands` ON  `tbl_carmodels`.brand =  `tbl_carbrands`.id ',
			);

		$allowJoin=array('CarModels'=>false,'carBrands'=>false);
		
		foreach ($params as $key => $value) {

			if (!empty($_POST[$key]))
			{
				$criteria->addCondition($value.'='.$_POST[$key]);
			}
		}

		$criteria->join.= $joins['Categories'];
		$criteria->join.= $joins['CarModels'];
		$criteria->join.= $joins['carBrands'];
		
		$dataProvider=new CActiveDataProvider('Parts', array(
				'criteria' => $criteria,
				'pagination'=>false,
			));

		$this->render('parts',array('dataProvider'=>$dataProvider));
	}

	public function actionView($id)
	{
		$model=News::model()->find('id=:id',array(':id'=>$id));
		$this->render('view',array('model'=>$model));
	}

	public function getDetails($params = array())
	{
		if (!empty($params))
		{
			foreach($params['conditions'] as $key=>$value)
			{
				if (!empty($value))
				{

				}
			}
		}
	}
	
}
