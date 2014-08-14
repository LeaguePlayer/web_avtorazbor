<?php

class AccountController extends Controller
{
	public $defaultAction = 'index';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function actionIndex(){

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl('application').'/js/account.js', CClientScript::POS_END);

		$model=User::model()->findByPk(Yii::app()->user->id);
		// 
		$changePwdModel=new UserChangePassword;
		$valid=false;

		if (isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			$valid=$model->save();
		}

		if (!empty($_POST['UserChangePassword']) && $valid)
		{
			
			$changePwdModel->attributes=$_POST['UserChangePassword'];
			$valid=$changePwdModel->validate();

			if ($valid)
			{
				$model->password=Yii::app()->getModule('user')->encrypting($_POST['UserChangePassword']['password']);
				$model->save();
			}
		} else {
			$changePwdModel=new UserChangePassword;
		}

		$this->render('index',array('model'=>$model,'changePwdModel'=>$changePwdModel));
	}
}