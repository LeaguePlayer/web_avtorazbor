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
			array(
				'allow',
				'actions'=>array('issue_the_order'),
				'users'=>array('@'),
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

	public function actionIssue_the_order()
	{

		$positions = Yii::app()->cart->getPositions();

		if (count($positions))
		{
			$request=new Requests;
			$request->client_id=Yii::app()->user->id;
			$request->from=0;
			$request->user_id=1;
			$request->date_life=date('d-m-y');
			$request->status=7;
			$request->save();

			$dbCommand = Yii::app()->db->createCommand();
			foreach ($positions as $key => $item) {

				$dbCommand->insert('{{PartsInRequest}}',array(
    					'request_id' => $request->id,
    					'part_id' => $item->id
    				)
				);
			}
			Yii::app()->cart->clear();
			$this->redirect(Yii::app()->getHomeUrl());
		}
		$this->render('index',array('models'=>$positions));
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

