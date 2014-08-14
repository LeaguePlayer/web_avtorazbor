<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AuthForm extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe;

	/**
	 * Declares the validation rules.
	 * The rules state that mail and password are required,
	 * and password needs to be authenticated.
	 */

	public function rules()
	{
		return array(
			// username and password are required
			array('email, email', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */

	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Запомнить меня',
			'email'=>'e-mail',
			'password'=>'Пароль',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity($this->email,$this->password);
			$identity->authenticate();

			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? Yii::app()->controller->module->rememberMeTime : 0;
					Yii::app()->user->login($identity,$duration);
					break;
				// case UserIdentity::ERROR_EMAIL_INVALID:
				// 	$this->addError("email",UserModule::t("Не верно заданы логин или пароль"));
				// 	break;
				// case UserIdentity::ERROR_STATUS_NOTACTIV:
				// 	$this->addError("status",UserModule::t("You account is not activated."));
				// 	break;
				// case UserIdentity::ERROR_STATUS_BAN:
				// 	$this->addError("status",UserModule::t("You account is blocked."));
				// 	break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password",UserModule::t("Не верно заданы логин или пароль"));
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError("username",UserModule::t("Не верно указаны email или пароль"));
					break;
			}
		}
	}
}
