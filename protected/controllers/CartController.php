<?php

class CartController extends FrontController
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
				'actions'=>array('index','removePosition'),
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
		$cs->registerScriptFile($this->getAssetsUrl().'/js/cart.js', CClientScript::POS_END);

		$models=Yii::app()->cart->getPositions();
		$this->render('index',array('models'=>$models));
	}

	public function actionRemovePosition($articul,$position)
	{
		$response['error']='Ошибка сервера! Пожалуйста повторите попытку позднее!';
		$model=Parts::model()->findByPk($articul);
		
		if ($model && Yii::app()->cart->contains($model->getId()))
		{

			Yii::app()->cart->remove($model->getId());
			$response['success']=true;
		} else {
			$response['error']='В корзине не был найден товар с данным ключем!';			
		}

		echo CJSON::encode($response);
		die();
	}

}

