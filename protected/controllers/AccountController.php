<?
	class AccountController extends Controller{

		public $message=false;

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
	                'actions'=>array('login', 'registration'),
	                'users'=>array('?'),
	            ),
	            array('allow',
	                'actions'=>array('logout','index','entry_list'),
	                'roles'=>array('@'),
	            ),
	        );
	    }

		public function actionIndex()
		{
			if (!Yii::app()->user->isGuest)
			{
				$model=Clients::model()->findBypk(Yii::app()->user->id);
				$changePwd=new ChangePwd;

				if (isset($_POST['Clients']))
				{
					$model->attributes=$_POST['FrontUser'];
					$modelValid=$model->validate();	
					$model->save();

					if (isset($_POST['ClientsInfo']) && $modelValid)
					{
						$info=new Clientsinfo;
						$info->attributes=$_POST['ClientsInfo'];
						$info->client_id=$model->id;

						if ($info->save())
						{
							$model->type=2;
							$model->save();
						}
					}

					if (!empty($_POST['ChangePwd']['oldPassword']) && $modelValid)
					{
						$changePwd->attributes=$_POST['ChangePwd'];
						$changePwdValid=$changePwd->validate();
						if ($changePwdValid)
						{
							$model->password=$changePwd->password;
							$changePwd=new ChangePwd;
							$this->message="Пароль успешно изменен!";
						}
					}
				}
				$this->render('account',
					array(
						'model'=>$model,
						'changePwd'=>$changePwd,
						'tabActive'=>($_POST['tabActive'] ? $_POST['tabActive'] : 1),
						'info'=>$model->info ? $model->info : new ClientsInfo,
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

			$authForm=new AuthForm;
			if (isset($_POST['AuthForm']))
			{
				$authForm->attributes=$_POST['AuthForm'];
				var_dump($_POST);
				die();
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
						$this->redirect(array('/')); 
					}
						
				}
				$this->render('registration',array('model'=>$regForm));
			}
			else 
			$this->redirect(Yii::app()->getHomeUrl());
		}

		public function actionEntry_list()
		{
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile($this->getAssetsUrl('application').'/js/cart.js', CClientScript::POS_END);
			$client=Clients::model()->findByPk(Yii::app()->user->id);

			$this->render('entry_list',array('models'=>$client->requests));
		}
	}

?>