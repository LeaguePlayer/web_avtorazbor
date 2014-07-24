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
				'actions'=>array('getNestedList','getCarModels','getSubCategories','getDetail'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetNestedList()
	{

		$params=$_GET['data'];
		$models=CHtml::listData(SiteHelper::getNestedModels($params),'id','name');

		$select=$this->renderPartial('//common/dropDownSelect',array('models'=>$models,'modelName'=>$params['model']),true);
		$list=$this->renderPartial('//common/DropDownList',array('models'=>$models,'modelName'=>$params['model']),true);

		$response=array();
		$response['select']=$select;
		$response['list']=$list;

		print(CJSON::encode($response));
		die();
	}

	public function actionGetCarModels()
	{

		$models=$models=CHtml::listData(CarModels::model()->findAll('brand=:id',array(':id'=>$_GET['value'])),'id','name');
		$select=$this->renderPartial('//common/dropDownSelect',array('models'=>$models,'modelName'=>$params['model'],'options'=>CarModels::getHtmlOptions()),true);

		$response=array();
		$response['select']=$select;

		print(CJSON::encode($response['select']));
		die();
	}

	public function actionGetSubCategories()
	{

		$models=$models=CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$_GET['value'])),'id','name');
		$select=$this->renderPartial('//common/dropDownSelect',array('models'=>$models,'modelName'=>$params['model'],'options'=>Categories::getHtmlOptions()),true);
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

}

