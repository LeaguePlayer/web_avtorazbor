<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class RecoveryPassword extends CFormModel {
	public $email;
	public $newPassword;
	public $verifyPassword;
	public $hash;

	public function rules() {
		return array(
				array('hash','checkHash'),
				array('newPassword,hash','safe'),
				array('email','match','pattern'=>'/[0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i','message'=>'Введенный адрес не является адресмо электронной почты!'),
				array('email','checkEmail','message' => "Не верно указан адрес электронной почты!"),
				array('verifyPassword', 'compare', 'compareAttribute'=>'newPassword', 'message' => "Не совпадают пароли!"),
			);
	}

	/**
	 * Declares attribute labels.
	 */

	public function checkHash(){
		$Client=Clients::model()->findByAttributes(array('hash'=>$this->hash));
		if (!$Client)
			$this->addError('hash','Токен не существует!');
	}

	public function attributeLabels()
	{
		return array(
			'email'=>'E-mail',
			'newPassword'=>'Новый пароль',
			'verifyPassword'=>'Повторите ввод нового пароля',
		);
	}

	public function sandHash(){
		$hash=Yii::app()->getModule('user')->encrypting($this->email.date('mm-dd-yyyy'));
		$Client=Clients::model()->findByAttributes(array('email'=>$this->email));
		$Client->hash=$hash;
		$Client->save();
		$siteName=Yii::app()->controller->createAbsoluteUrl('/');
		$message='Для восстановления пароля на сайте '.$siteName.' перейдите по ссылке '.$siteName.'/account/recoveryPassword/'.$hash;
		SiteHelper::sendMail(Yii::app()->name.' - Востановление пароля',$message,$this->email);
	}

	public function changePwd(){
		$Client=Clients::model()->findByAttributes(array('hash'=>$this->hash));
		$Client->password=Yii::app()->getModule('user')->encrypting($this->newPassword);
		$Client->hash=null;
		return $Client->save();
	}

	public function checkEmail($attribute,$params){

		$client=Clients::model()->findByAttributes(array('email'=>$this->$attribute));
		if (!$client)
			$this->addError($attribute, "Не был найден пользователь с указаным адресом электронной почты!");
	}
}