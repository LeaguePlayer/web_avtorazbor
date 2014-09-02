<?php

class CartController extends FrontController
{
	public $layout = '//layouts/simple';
	public $renderLoginForm=false;
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
		$cs->registerScriptFile($this->getAssetsUrl().'/js/cart.js', CClientScript::POS_END);

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
			$request->status=7;
			$request->date_life=date('d-m-y');
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
			Yii::app()->cart->remove($model->getId());
			$response['success']=true;
			$response['html']= Yii::app()->cart->getCount() ? 
						'<ul>
        				    <li>
        					<a href="/cart">'+Yii::app()->cart->getCount()+" товар"+'</a>
        				    </li>
        				    <li>
        					На сумму: <strong>'+Yii::app()->cart->getCost()+' руб.</strong>
        			     	</li>
        			  	</ul>' : 
        			  	'<span>товаров нет</span>';
		} else {
			$response['error']='В корзине не был найден товар с данным ключем!';			
		}

		echo CJSON::encode($response);
		die();
	}

}

