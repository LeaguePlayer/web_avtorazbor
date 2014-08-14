<?php

class RegistrationController extends Controller
{   
    public $layout = '//layouts/main';
	public $defaultAction = 'registration';
	
	public function actionRegistration() {

         if (!Yii::app()->user->isGuest) {
             throw new CException('Вы уже зарегистрированны!');

        } else {
            $regForm=new RegistrationForm;

            if (isset($_POST['RegistrationForm']))
            {
                $regForm->attributes=$_POST['RegistrationForm'];

                $valid=$regForm->validate();

                if ($valid)
                {
                    $regForm->save();
                    $this->redirect(array('/user/authenticate'));
                }
            }
            $this->render('/user/registration',array('model'=>$regForm));
        }
    }
}