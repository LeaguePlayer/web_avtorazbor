<?php

class AuthenticateController extends Controller
{
	public $defaultAction = 'Auth';
    public $layout = '//layouts/main';

	/**
	 * Displays the login page
	 */
	public function actionAuth()
	{

			$model=new UserAuth;
			if (Yii::app()->user->isGuest)
			{
				if (isset($_POST['UserAuth']))
				{
					$model->attributes=$_POST['UserAuth'];
					$model->validate();
				}
			}

			if (Yii::app()->user->isGuest)
				$this->render('/user/Auth',array('model'=>$model));	
			else 
				Yii::app()->getRequest()->redirect(Yii::app()->getHomeUrl());
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit_at = date('Y-m-d H:i:s');
		$lastVisit->save();
	}

}