<?php

class ExitController extends Controller
{
	public $defaultAction = 'Exit';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	
	public function actionExit()
	{
		Yii::app()->user->logout();
		Yii::app()->getRequest()->redirect(Yii::app()->getHomeUrl());
	}

}