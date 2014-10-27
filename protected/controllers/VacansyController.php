<?php

class VacansyController extends FrontController
{
	public $layout='//layouts/simple';
	public $viewTitle="Вакансии";
	
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Vacansy', $id),
		));
	}

	
	public function actionIndex()
	{
		$this->layout='//layouts/content';
		$criteria=new CDbCriteria;
		$criteria->addCondition('status=1');
		$dataProvider=new CActiveDataProvider('Vacansy',
			array('criteria'=>$criteria,
				'pagination'=>array(
					'pageSize'=>10,
				)
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
