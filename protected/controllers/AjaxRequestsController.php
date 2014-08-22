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

		$model=$_GET['model'];
		$nested=$_GET['nested'];
		$value=$_GET['value'];

		switch ($model) {

			case 'country':
					{
						$models=CHtml::listData(CarBrands::model()->findAll('id_country=:id',array(':id'=>$value)),'id','name');
						$htmlOptions=array('id'=>'carBrands','data-nested'=>'#carModels','empty'=>'Выберите марку');
					}
				break;
			case 'carBrands':
					{
						$models=CHtml::listData(CarModels::model()->findAll('brand=:id',array(':id'=>$value)),'id','name');
						$htmlOptions=array('id'=>'carModels', 'data-nested'=>'#carModels', 'empty'=>'Выберите модель');
					}
				break;
			case 'carModels':
					{
						$models=CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$value)),'id','name');
						$htmlOptions=array('id'=>'carBrands','data-nested'=>'#carModels');
					}
			case 'Categories':
					{

						$models= $value ? CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$value)),'id','name') : array();
						$htmlOptions=array('id'=>'subCategories','empty'=>'Выберите подкатегорию');
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

