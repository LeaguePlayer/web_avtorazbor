<?php

class CartController extends FrontController
{
	public $layout = '//layouts/simple';
	public $renderLoginForm=false;
	public $modelName="Корзина";
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
				'actions'=>array('index','removePosition','view'),
				'users'=>array('*'),
			),
			array(
				'allow',
				'actions'=>array('issueBook'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetuserProfile()
	{
		$user=Clients::model()->findByPk(Yii::app()->user->id);
		if ($user)
			$this->renderPartial('userForm',array('model'=>$user,'info'=>$user->info));
	}

	public function actionIndex()
	{

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/cart.js?v=2', CClientScript::POS_END);

		$positions = Yii::app()->cart->getPositions();
		$client=Clients::model()->findByPk(Yii::app()->user->id);
		$request=new Requests;
		$request->attributes=$client->attributes;
		if (count($positions) && isset($_POST['Requests']))
		{
			$request=new Requests;
			$request->attributes=$_POST['Requests'];
			$request->client_id=Yii::app()->user->id;
			$request->from=0;
			$request->user_id=1;
			$request->status=3;
			$hours=Settings::getValue('request_time');
			$hours=!empty($hours) ? $hours : 0;
			$time = strtotime("+ $hours hours");
			$request->date_life=date('Y-m-d', $time);
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
			$this->redirect('/page/thanks');
		} else {
			$this->render('index',array('models'=>Yii::app()->cart->getPositions(),'model'=>$request));
		}
	}

	// public function actionIssueBook()
	// {
	// 	$positions = Yii::app()->cart->getPositions();

	// 	$request=new Requests;

	// 	if (count($positions) && isset($_POST['Requests']))
	// 	{
	// 		$request=new Requests;
	// 		$request->attributes=$_POST['Requests'];
	// 		$request->client_id=Yii::app()->user->id;
	// 		$request->from=0;
	// 		$request->user_id=1;
	// 		$request->status=7;
	// 		$request->save();

	// 		$dbCommand = Yii::app()->db->createCommand();
	// 		foreach ($positions as $key => $item) {

	// 			$dbCommand->insert('{{PartsInRequest}}',array(
 //    					'request_id' => $request->id,
 //    					'part_id' => $item->id
 //    				)
	// 			);
	// 		}
	// 		Yii::app()->cart->clear();
	// 		$this->redirect('/page/thanks');
	// 	} else {
	// 		$this->render('index',array('models'=>Yii::app()->cart->getPositions(),'model'=>$request));
	// 	}
	// }

	public function actionRemovePosition($articul,$position)
	{
		$response['error']='Ошибка сервера! Пожалуйста повторите попытку позднее!';
		$model=Parts::model()->findByPk($articul);
		
		if ($model && Yii::app()->cart->contains($model->getId()))
		{
			$cart=Yii::app()->cart;
			$cart->remove($model->getId());
			$response['success']=true;
			$response['html']= $cart->getCount() ? 
						'<ul>
        				    <li>
        						<a href="/cart">'.Yii::t('app', '{n} товар|{n} товара|{n} товаров', $cart->getCount()).'</a>
        				    </li>
        				    <li>
	        				    <a href="/cart">
	        						На сумму: <strong>'.$cart->getCost().' руб.</strong>
	        					</a>
        			     	</li>
        			  	</ul>' : 
        			  	'<span>товаров нет</span>';
        	$response['count']=$cart->getCount();
		} else {
			$response['error']='В корзине не был найден товар с данным ключем!';			
		}

		echo CJSON::encode($response);
		die();
	}

}

