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
				'actions'=>array('index','view','parts','AjaxUpdate','disc','addToCart'),
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

		// $cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/detail.js', CClientScript::POS_END);

		if(!Yii::app()->request->isAjaxRequest)
		{
			$Brand=CHtml::listData(CarBrands::model()->findAll(),'id','name');
			$this->render('index',array('Brand'=>$Brand));
		}
	}

	public function actionDisc()
	{

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/disc.js', CClientScript::POS_END);
    	
    	if( !Yii::app()->request->isAjaxRequest )
    	{
    		$dataProvider=Parts::model()->Disc($_GET['min'],$_GET['max']);
			$this->render('disc',
				array('dataProvider'=>$dataProvider,
						'min'=>$_GET['min'],
						'max'=>$_GET['max'],
					)
				);
		}
		else {

			$data=$_GET['data'];

			$pagination=array('pageSize'=>$data['display']);

			$dataProvider=Parts::model()->Disc($data['min'],$data['max']);
			
			$dataProvider->criteria->addCondition('price_buy>='.$data['minCost'].' and price_buy<='.$data['maxCost']);
			$dataProvider->criteria->order=$data['sort'].' desc';

			print($this->renderPartial('tabParts',
				array(
					'dataProvider'=>$dataProvider,


				),true));
		}

	}
	
	public function actionParts()
	{
		$_GET['car_type']= $_GET['car_type'] ? $_GET['car_type'] : 1;
		$cs = Yii::app()->clientScript;

		$session=Yii::app()->session;
		unset($session["backToResultUrl"]);

    	$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
	    $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		$params=array('car_type'=>$_GET['car_type']);


		foreach (array('carBrands'=>'brand','carModels'=>'car_model_id',) as $key => $value) {

			if (!empty($_GET[$key]))
			{
				$params['column']=$value;
				$params['value']=$_GET[$key];
			}
		}
		
		$category=!empty($_GET['Categories']) ? $_GET['Categories'] : !empty($_GET['subCategories']) ? $_GET['subCategories'] : '';

		$Countries=CHtml::listData(Country::model()->findAll(),'id','name');
		$country_id=$_GET['country'];
		$Categories=CHtml::listData(Categories::model()->findAll('parent=0'),'id','name');

		if (!empty($_GET['carModels']))
		{
			$car_model=CarModels::model()->findByPk($_GET['carModels']);
			$Brands_id=$car_model->car_brand->id;
			$_GET['carBrands']=$Brands_id;

		} else {
			$Brands_id=$_GET['carBrands'];
		}

		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		
		$Model_id=$_GET['carModels'];
		$Models=!empty($Brands_id) ? CHtml::listData(CarBrands::model()->findByPk($_GET['carBrands'])->models(),'id','name') : array();
		
		$subCategories=$_GET['subCategories'];
		$subCategories=!empty($subCategories) ? CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$_GET['Categories'])),'id','name') : array();
		$criteria=new CDbCriteria;
		$criteria->addCondition('car_model_id=0');

		$dataProvider=new CActiveDataProvider('Parts',array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>20
				),
		));
		$this->render('parts',
			array(
				'model'=>$model,
				'country_id'=>$country_id,
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
				
		$sort=$data['pager']['sort'];
		$display=$data['pager']['display'];
		$equal=$data['conditions']['equal'];

		$category_id=$equal['category_id'];
		$model_id=$equal['car_model_id'];
		$parent=$equal['parent'];

		$params['car_type']=$data['conditions']['equal']['car_type'];
		$params['condition']='price_buy>='.$data['conditions']['MoreEqual']['price_buy'].
							 ' and price_buy<='.$data['conditions']['LessEqual']['price_buy'];

		foreach ($equal as $key => $value){

			if ($key=="category_id")
				break;
			if (!empty($value) && $key!='car_type')
			{
				$params['value']=$value;
				$params['column']=$key;
			}
		}

		$criteria=new CDbCriteria;

		if (empty($parent) || empty($model_id)){	

			$criteria=Parts::model()->search_parts($params['column'],$params['value'],$params['car_type']);
		}
		else {
			
			$criteria=Parts::model()->search_parts('model_cat',array('model_id'=>$model_id,'cat_id'=>$parent));
		}
		
		$criteria->addCondition('price_buy>='.$data['conditions']['MoreEqual']['price_buy'].
								' and '.'price_buy<='.$data['conditions']['LessEqual']['price_buy']);

		$criteria->addCondition('car_type='.$params['car_type']);

		if (!empty($parent))
			$criteria->addCondition('parent='.$parent);

		if (!empty($category_id))
			$criteria->addCondition('category_id='.$category_id);

		$criteria->order = $sort.' desc';

		$dataProvider=new CActiveDataProvider('Parts',array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>$display,
				)
			)
		);

		echo $this->renderPartial('//detail/tabParts',array('dataProvider'=>$dataProvider),true);

	}

	public function actionView()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/partsView.js', CClientScript::POS_END);
		$id=$_GET['id'];

		if (!Yii::app()->session->get("backToResultUrl"))
		{
			$backToResultUrl='country='.$_GET['country'].'&carBrands='.$_GET['carBrands'].'&carModels='.
					$_GET['carModels'].'&Categories='.$_GET['Categories'].'&subCategories='.$_GET['subCategories'];
			Yii::app()->session->add("backToResultUrl",$backToResultUrl);
		}

		$model=Parts::model()->findByPk($id);

		$brand=$model->car_model->car_brand->id;
		$car_model=$model->car_model->id;
		$category_id=$model->category->id;

		$criteria=Parts::model()->search_parts('model_cat',array('model_id'=>$car_model,'cat_id'=>$category_id));
		$criteria->addCondition('category_id='.$category_id);
		$dataProvider=new CActiveDataProvider('Parts',
			array(
				'criteria'=>$criteria,
				'pagination'=>false,
			)
		);
		$this->render('view',array('model'=>$model,'dataProvider'=>$dataProvider,'backToResultUrl'=>$backToResultUrl));
	}


}
