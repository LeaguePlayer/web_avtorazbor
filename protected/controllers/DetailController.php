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
				'actions'=>array('index','view','parts','AjaxUpdate'),
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

		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		if(!Yii::app()->request->isAjaxRequest)
		{

			$Brand=CHtml::listData(CarBrands::model()->findAll(),'id','name');
			$this->render('index',array('Brand'=>$Brand));
		}

	}

	public function actionParts()
	{

		$cs = Yii::app()->clientScript;
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
	    
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		$join=strtolower(
				"LEFT JOIN  `tbl_categories` ON  `tbl_categories`.id =  `t`.category_id
                LEFT JOIN  `tbl_CarModels` ON  `t`.car_model_id =  `tbl_CarModels`.id
                LEFT JOIN  `tbl_CarBrands` ON  `tbl_CarModels`.brand =  `tbl_CarBrands`.id");



		$criteria=new CDbCriteria;
		$criteria->join=$join;
		$criteria->order='`t`.id desc';

		if (isset($_POST['car_type']))	
			$criteria->addCondition('car_type='.$_POST['car_type']);

		foreach (array('carBrands'=>'brand','carModels'=>'car_model_id','Categories'=>'category_id','subCategories'=>'parent') as $key => $value) {

			if (!empty($_POST[$key]))
			{

				$criteria->addCondition($value.'='.$_POST[$key]);

			}
		}

		$dataProvider=new CActiveDataProvider('Parts', array(
			'criteria' => $criteria,
			'pagination'=>array(
		        'pageSize'=>2,
		        'pageVar'=>'page',
		    ),
		));

		$Countries=CHtml::listData(Country::model()->findAll(),'id','name');

		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		$Brands_id=$_POST['carBrands'];

		$Models=array();

		if ($_POST['carBrands'])
		{
			$Models=CHtml::listData(CarBrands::model()->findByPk($_POST['carBrands'])->models(),'id','name');
			$Model_id=$_POST['carModels'];
		}
		
		$Categories=CHtml::listData(Categories::model()->findAll('parent=0'),'id','name');

		$subCategories=array();

		if (!empty($_POST['subCategories']));
		{
			$subCategories=CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$_POST['Categories'])),'id','name');		
		}
		
		$this->render('parts',array(
								'model'=>$model,
								'Countries'=>$Countries,
								'Brands'=>$Brands,
								'Brands_id'=>$Brands_id,
								'Models'=>$Models,
								'Model_id'=>$Model_id,
								'Categories'=>$Categories,
								'Category_id'=>$_POST['Categories'],
								'subCategories'=>$subCategories,
								'subCategory_id'=>$_POST['subCategories'],
								'dataProvider'=>$dataProvider,
							));
	}

	public function actionAjaxUpdate()
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

		$criteria->join=strtolower(
				"LEFT JOIN  `tbl_categories` ON  `tbl_categories`.id =  `t`.category_id
                LEFT JOIN  `tbl_CarModels` ON  `t`.car_model_id =  `tbl_CarModels`.id
                LEFT JOIN  `tbl_CarBrands` ON  `tbl_CarModels`.brand =  `tbl_CarBrands`.id");

		$dataProvider=new CActiveDataProvider('Parts', array(
			'criteria' => $criteria,
			'pagination'=>array(
		        'pageSize'=>$pageSize,
		        'pageVar'=>'page',
		    ),
		));

		echo $this->renderPartial('//detail/tabParts',array('dataProvider'=>$dataProvider),true);
	}

	public function actionView($id)
	{
		
		$model=Parts::model()->find('id=:id',array(':id'=>$id));
		$this->render('view',array('model'=>$model));
	}
}
