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

		$models=Yii::app()->cart->getPositions();

		$user=Clients::model()->findByPk(Yii::app()->user->id);
		$info=$user->info;

		if (!$user)	
		{
			$user=new Clients;
			$info=new ClientsInfo;
		}
		$this->render('index',array('models'=>$models,'model'=>$user,'info'=>$info));
	}

	public function actionIssueBook()
	{
		$positions = Yii::app()->cart->getPositions();
		
		if (isset($_GET['Clients']))
		{
			$user=Clients::model()->findByPk(Yii::app()->user->id); 
			$user->attributes=$_GET['Clients'];

			if ($valid=$user->save())
			{
				$info=$user->info;
				$info->attributes=$_GET['ClientsInfo'];
				$infoValid=$info->save();
			}
		}
		$valid=$_GET['Clients']['type']== '1' ? $valid : $infoValid; //Юридическое или физическое лицо

		if (count($positions) && $valid)
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
			$this->redirect('/page/thanks');
		} else {
			$this->render('index',array('models'=>Yii::app()->cart->getPositions(),'model'=>$user,'info'=>$info));
		}
	}

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

