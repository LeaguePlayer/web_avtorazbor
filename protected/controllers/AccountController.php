<?
	class AccountController extends Controller{
		public $layout='/layouts/content';
		public $message=false;
		public $modelName="Личный кабинет";
		public $viewTitle='';

		public function filters()
	    {
	        return array(
	            'accessControl',
	        );
	    }

	    public function accessRules()
	    {
	        return array(
	            array('allow',
	                'actions'=>array('login', 'registration','recoveryPassword'),
	                'users'=>array('?'),
	            ),
	            array('deny',
	                'actions'=>array('index','entry_list','RecoveryPassword'),
	                'roles'=>array('isAdmin'),
	            ),
	            array('allow',
	                'actions'=>array('logout','index','entry_list'),
	                'roles'=>array('@'),
	            ),

	        );
	    }
	    public function actionRecoveryPassword($hash=null){

	    	$this->layout='//layouts/content';
	    	$this->viewTitle="Восстановление пароля";
	    	$RecoveryPassword=new RecoveryPassword;
	    	$RecoveryPassword->hash=$hash;
	    	$RecoveryPassword->validate();

	    	if ($RecoveryPassword->errors['hash'] && $hash!=null)
	    			throw new CHttpException(404,'Страница не найдена');

	    	if ($hash===null)
	    	{
	    		if (isset($_POST['RecoveryPassword']))
	    		{
	    			$RecoveryPassword->attributes=$_POST['RecoveryPassword'];
	    			if ($RecoveryPassword->validate())
	    			{
	    				$RecoveryPassword->sandHash();
	    				$this->redirect(array('/page/recover_password_instructions'));
	    			}
	    		}
	    		$this->render('recoveryPassword',array('model'=>$RecoveryPassword));
	    	} else {
	    		if (isset($_POST['RecoveryPassword'])){

	    			$RecoveryPassword->attributes=$_POST['RecoveryPassword'];
	    			if ($RecoveryPassword->validate())
	    			{
	    				if ($RecoveryPassword->changePwd()){
	    					$this->redirect(array('/page/password_changed'));
	    				}
	    			}
	    			
	    		}
	    		$this->render('recoveryPasswordHash',array('model'=>$RecoveryPassword));
	    	}
	    }
		public function actionIndex()
		{
			$this->breadcrumbs=array('Личный кабинет');
			$this->viewTitle="Личный кабинет";
			if (!Yii::app()->user->isGuest)
			{
				$model=Clients::model()->findBypk(Yii::app()->user->id);
				$info=$model->info ? $model->info[0] : new ClientsInfo;
				$changePwd=new ChangePwd;

				if (isset($_POST['Clients']))
				{
					$model->attributes=$_POST['Clients'];
					$modelValid=$model->validate();	
					
					if (isset($_POST['ClientsInfo']))
					{
						if ($modelValid)
						{

							$info->attributes=$_POST['ClientsInfo'];
							if ($info->validate())
							{
								$model->type=2;
								$model->save();
								$info->client_id=$model->id;
								$info->save();
							}
						}
					} else
						$model->save();
					///Смена пароля!!!!!!!!!!
					if (!empty($_POST['ChangePwd']['oldPassword']) && $modelValid)
					{
						$changePwd->attributes=$_POST['ChangePwd'];
						$changePwdValid=$changePwd->validate();

						if ($changePwdValid)
						{
							//$changePwd->save();
							$model->password=Yii::app()->getModule('user')->encrypting($changePwd->password);
							$model->save();
							$this->message="Пароль был успешно изменен!";
							$changePwd=new ChangePwd;

						}else {
							foreach ($changePwd->errors as $key => $value) {
								$this->message.=$value[0];
							}
							
						}
					}
				}
				$this->render('account',
					array(
						'model'=>$model,
						'changePwd'=>$changePwd,
						'tabActive'=>($_POST['tabActive'] ? $_POST['tabActive'] : 1),
						'info'=>$model->info ? $info : new ClientsInfo,
						'message'=>$this->message
					)
				);
			} else {
				throw new CHttpException("У вас не достаточно прав для этого действия! Пожалуйста авторизируйтесь", 403);
			}				
		}

		public function actionLogin()
		{
			$response['success']=false;
			$this->viewTitle="Авторизация";
			$authForm=new AuthForm;
			if (isset($_POST['AuthForm']))
			{
				$authForm->attributes=$_POST['AuthForm'];
				
				$valid=$authForm->validate();
				 if ($valid)
				 {
				 	$response['success']=true;
				 	$response['lk']='<ul>
                     	<li>
        					<a href="/account">Личный кабинет</a>
        				</li>
        				<li>
        					<a href="/account/logout">Выйти</a>
        				</li>
                    </ul>';
                    if ($_POST['controller']=='cart')	
                    {
                    	$request=new Requests;
                    	$client=Clients::model()->findByPk(Yii::app()->user->id);
                    	$request->attributes=$client->attributes;
                    	$response['user']=$this->renderPartial('//cart/user',array('model'=>$request),true);
                    }
                    echo CJSON::encode($response);
                    die();
				 } else {
				 	$response['error']=$authForm->errors;
				 	echo CJSON::encode ($response);
				 }
			}
		}

		public function actionLogout()
		{
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->getHomeUrl());
		}

		public function actionRegistration()
		{
			$regForm=new RegistrationForm;
			$this->breadcrumbs=array('Регистрация');
			$this->viewTitle="Регистрация";
			if (Yii::app()->user->isGuest)
			{
				if (isset($_POST['RegistrationForm']))
				{
					$regForm->attributes=$_POST['RegistrationForm'];
					$valid=$regForm->validate();
					if ($valid)
					{
						$regForm->type=1;
						$regForm->save();
						Yii::app()->user->id=$regForm->id;
						$this->redirect(Yii::app()->getHomeUrl()); 
					}
						
				}
				$this->render('registration',array('model'=>$regForm));
			}
			else
				$this->redirect(Yii::app()->getHomeUrl());
		}

		public function actionEntry_list()
		{
			$this->breadcrumbs=array('Личный кабинет'=>'/account/', 'Список заказов');
			$this->viewTitle="Список заказов";
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile($this->getAssetsUrl('application').'/js/cart.js?v=2', CClientScript::POS_END);
			$client=Clients::model()->findByPk(Yii::app()->user->id);

			$this->render('entry_list',array('models'=>$client->requests));
		}
	}

?>