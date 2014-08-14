<?
	class RegistrationForm extends Clients{

		public $verifyPassword;
		public $password;

		public function rules()
		{
			$rules = array(
				array('password, verifyPassword, email, phone, fio', 'required'),
				array('email','match','pattern'=>'/[0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i','message'=>'Введенный адрес не является адресмо электронной почты!'),
				array('password', 'length', 'max'=>128, 'min' => 4,'message' => "Длина логина должна занимать от 4 до 128 символов"),
				array('email', 'email'),
				array('email', 'unique', 'message' => 'Пользователь с указанным почтовым адресом 	был зарегестрирован ранее!'),
				array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => 'Пароли не совпадают!'),
			);
			return $rules;
		}

		public function beforeSave()
		{

			if (!empty($this->password))
			{
				$this->password=Yii::app()->getModule('user')->encrypting($this->password);
			}

			return true;
		}
	}
?>