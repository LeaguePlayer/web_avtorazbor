<?php

class AjaxRequestsController extends FrontController
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
				'actions'=>array('getNestedList','getCarModels','getSubCategories','getDetail','saveQuestion','saveBookPart','saveOwnPrice'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetNestedList()
	{
		$searchingIn=$_GET['searchingIn'];
		$model=$_GET['model'];
		$nested=$_GET['nested'];
		$value=$_GET['value'];
		$type=$_GET['type'] ? $_GET['type'] : 1 ;
		switch ($model) {

			case 'country':
					{
						$criteria=$searchingIn::getExistsData($value,'id_country','brand',$type);
						$models=CHtml::listData(CarBrands::model()->findAll($criteria),'id','name');
						$htmlOptions=array('id'=>'carBrands','data-nested'=>'#carModels','empty'=>'Выберите марку');
					}
				break;
			case 'Type':
				{		
					$criteria=$searchingIn::getExistsData(null,null,'brand',$type);
					
					$models=CHtml::listData(CarBrands::model()->findAll($criteria),'id','name');
					$htmlOptions=array('id'=>'carBrands', 'data-nested'=>'#carBrands', 'empty'=>'Выберите марку');
				}
			break;
			case 'carBrands':
					{
						$criteria=$searchingIn::getExistsData($value,'brand','car_model_id',$type);
						$models=CHtml::listData(CarModels::model()->findAll($criteria),'id','name');
						$htmlOptions=array('id'=>'carModels', 'data-nested'=>'#carModels', 'empty'=>'Выберите модель');
					}
				break;
			case 'carModels':
					{
						$criteria=$searchingIn::getExistsData($value,'car_model_id','parent',$type);
						$models=CHtml::listData(Categories::model()->findAll($criteria),'id','name');
						$htmlOptions=array(
							'id'=>'Categories',
							'data-nested'=>'#subCategories',
							'empty'=>'Выберите категорию'
						);
					}
				break;
			case 'Categories':
					{
						$criteria=$searchingIn::getExistsData($value,'car_model_id','category_id',$type);
						$models=CHtml::listData(Categories::model()->findAll($criteria),'id','name');
						$htmlOptions=array('id'=>'subCategories','empty'=>'Выберите подкатегорию');
					}
			break;
			case 'bascet':
					{
						$criteria=$searchingIn::getExistsData($value,'car_model_id','bascet',$type);
						$bascet=UsedCars::getBasketList() + UsedCars::getWeightBasketList();
						$models=array();

						foreach ($criteria->params as $key => $id) {
							$models[$id]=$bascet[$id];
						}

						$htmlOptions=array('id'=>'bascet','empty'=>$models ? 'Выберите кузов' : 'Не определено');
					}
			break;
			case 'state':
					{
						$criteria=$searchingIn::getExistsData($value,'car_model_id','state',$type);
						$models=array();
						$state=UsedCarInfo::statesList();
						foreach ($criteria->params as $key => $id) {
							$models[$id]=$state[$id];
						}
						//var_dump($models);die();
						$htmlOptions=array('id'=>'state','empty'=>'Выберите состояние');
					}
			break;
			case 'transmission':
					{
						$criteria=$searchingIn::getExistsData($value,'car_model_id','transmission',$type);
						
						$models=array();
						$transmission=UsedCarInfo::transmissionList();
						foreach ($criteria->params as $key => $id) {
							$models[$id]=$transmission[$id];
						}

						$htmlOptions=array('id'=>'transmission','empty'=>'Выберите подкатегорию');
					}
			break;
			default:
					$models=array(0=>'не определено');
				break;
		}

		$select=$this->renderPartial('//common/dropDownSelect',array( 'models'=>$models, 'Options'=>$htmlOptions ),true);
		echo ($select);
	}



	public function actionGetCarModels()
	{

		$models=CHtml::listData(CarModels::model()->findAll('brand=:id',array(':id'=>$_GET['value'])),'id','name');

		$select=$this->renderPartial('//common/dropDownSelect',array('models'=>$models,'Options'=>CarModels::getHtmlOptions()),true);

		$response=array();
		$response['select']=$select;

		print(CJSON::encode($response['select']));
		
		die();

	}

	public function actionGetSubCategories()
	{


		if (!empty($_GET['value']))
		{
			$models=$models=CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$_GET['value'])),'id','name');
		} else {
			$models=array();
		}

		$select=$this->renderPartial('//common/dropDownSelect',array('models'=>$models,'Options'=>Categories::getHtmlOptions()),true);
		$response=array();
		$response['select']=$select;

		print(CJSON::encode($response['select']));
		die();
	}

	public function actionGetDetail()
	{
		$data=$_GET['data'];
		$model=Parts::model()->find('id=:id',array(':id'=>$data['id']));
		$DetailView=$this->renderPartial('//detail/view',array('model'=>$model),true);

		echo $DetailView;
	}

	public function actionSaveQuestion()
	{
	    $model=new Questions;
	    $this->performAjaxValidation($model);
	    
	    if(isset($_POST['Questions']))
	    {
	        $model->attributes=$_POST['Questions'];
	        if ($model->validate())
	        {
	        	$model->save();
	        	echo $model->errors;
	        }
	        else {
	        	echo CActiveForm::validate($model);
	        	Yii::app()->end();
	        }
	    }
	}

	public function actionSaveBookPart()
	{
	    $model=new Bookpart;
	    //$this->performAjaxValidation($model);
	    $response=array();
	    if(isset($_POST['Bookpart']))
	    {
	        $model->attributes=$_POST['Bookpart'];
	        $response['test']=$model->attributes;
	        $response['test2']=$_POST['Bookpart'];
	        if ($model->validate())
	        {
	        	$model->status=2;
	        	$model->save();
	        	$response['success']=true;
	        }
	        else {
	        	$response['error']=$model->errors;
	        }
	    }
	    echo CJSON::encode($response);
	}

	public function actionsaveOwnPrice()
	{
	    $model=new Ownprice;

	    $response=array();

	    if(isset($_POST['Ownprice']))
	    {
	        $model->attributes=$_POST['Ownprice'];
	        
	        if ($model->validate())
	        {
	        	$model->status=2;
	        	$model->save();
	        	$response['success']=true;
	        }
	        else {
	        	$response['error']=$this->renderPartial('//forms/bookPart',array('model'=>$model),true);
	        }
	    }

	    echo CJSON::encode($response);
	}

	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']))
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
}

