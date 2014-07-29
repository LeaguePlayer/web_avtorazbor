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


		$criteria=new CDbCriteria;

		if (isset($_GET['car_type']))	
			$criteria->addCondition('car_type='.$_GET['car_type']);

		foreach (array('carBrands'=>'brand','carModels'=>'car_model_id','Categories'=>'category_id','subCategories'=>'parent') as $key => $value) {

			if (!empty($_GET[$key]))
			{

				$criteria->addCondition($value.'='.$_GET[$key]);

			}
		}

		$Countries=CHtml::listData(Country::model()->findAll(),'id','name');
		$Categories=CHtml::listData(Categories::model()->findAll('parent=0'),'id','name');

		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		$Brands_id=$_GET['carBrands'];

		$Models=array();
		$subCategories=array();

		if ($_GET['carBrands'])
		{
			$Models=CHtml::listData(CarBrands::model()->findByPk($_GET['carBrands'])->models(),'id','name');
			$Model_id=$_GET['carModels'];
		}

		if (!empty($_GET['subCategories']));
		{
			$subCategories=CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$_GET['Categories'])),'id','name');		
		}
		
		$dataProvider=$this->getDataProvider($criteria->condition);
		
		$this->render('parts',array(
								'model'=>$model,
								'Countries'=>$Countries,
								'Brands'=>$Brands,
								'Brands_id'=>$Brands_id,
								'Models'=>$Models,
								'Model_id'=>$Model_id,
								'Categories'=>$Categories,
								'Category_id'=>$_GET['Categories'],
								'subCategories'=>$subCategories,
								'subCategory_id'=>$_GET['subCategories'],
								'dataProvider'=>$dataProvider,
								'car_type'=>$data['car_type']
							));
	}

	public function actionAjaxUpdate()
	{

		$data=$_GET['data'];

		$criteria=new CDbCriteria;
		
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

		$dataProvider = $this->getDataProvider($criteria->condition);

		echo $this->renderPartial('//detail/tabParts',array('dataProvider'=>$dataProvider),true);
	}

	public function actionView($id)
	{
		
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/partsView.js', CClientScript::POS_END);
		
		$model=Parts::model()->findByPk($id);

		$brand=$model->car_model->car_brand->id;
		$car_model=$model->car_model->id;
		$category_id=!empty($model->category->parent) ? $model->category->parent : $model->category->id;

		$condition='car_model_id='.$car_model;

		$dataProvider=$this->getDataProvider($condition,false);

		$this->render('view',array('model'=>$model,'dataProvider'=>$dataProvider));

	}

	public function getDataProvider($condition,$pager=true)
	{

		$data=$_GET['data'];

		$display=$data['pager']['sort'] ? $data['pager']['sort'] : 'price_buy';
		$pageSize=$data['pager']['display'] ? $data['pager']['display'] : '2';

		$sql="select count(*)
				from (
					SELECT `t`.id as id,car_type,brand,car_model_id,category_id,parent,id_country,price_buy
					FROM `tbl_Parts` t
					LEFT JOIN `tbl_categories` ON `tbl_categories`.id = `t`.category_id
					LEFT JOIN `tbl_CarModels` ON `t`.car_model_id = `tbl_CarModels`.id
					LEFT JOIN `tbl_CarBrands` ON `tbl_CarModels`.brand = `tbl_CarBrands`.id
	                LEFT JOIN `tbl_country` ON `tbl_CarBrands`.id_country= `tbl_country`.id 
                    ".(!empty($condition) ? 'where '. $condition : '')." 
					UNION
					SELECT `t`.id as id,car_type,brand,car_model_id,category_id,parent,id_country,price_buy
					FROM `tbl_Parts` t
					LEFT JOIN `tbl_categories` ON `tbl_categories`.id = `t`.category_id
					LEFT JOIN `tbl_CarModels` ON `t`.car_model_id = `tbl_CarModels`.id
					LEFT JOIN `tbl_CarBrands` ON `tbl_CarModels`.brand = `tbl_CarBrands`.id
					LEFT JOIN `tbl_country` ON `tbl_CarBrands`.id_country= `tbl_country`.id
                    where car_model_id in (select model_2 from `tbl_Analogs` ".(!empty($data['carModels']) ? 'model_1='.$data['carModels'] : '').")
				) tbl ";	
	

		$count=Yii::app()->db->createCommand($sql)->queryScalar();
		$sql = str_replace('count(*)', 'id, car_model_id, car_type, parent, brand,category_id,id_country,'.$display, $sql);

		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    
		    'pagination'=>($pager ?array(
		        'pageSize'=>$pageSize,
		    ) : false ),
		));

		return $dataProvider;
	}

}