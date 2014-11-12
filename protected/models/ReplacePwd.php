<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class ReplacePwd extends CFormModel {
	public $email;
	public $newPassword;
	public $verifyPassword;

	public function rules() {
		return array(
				array('email','required'),
				array('email','match','pattern'=>'/[0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i','message'=>'Введенный адрес не является адресмо электронной почты!'),
				array('email','checkEmail','message' => "Не верно указан адрес электронной почты!"),
				array('verifyPassword', 'compare', 'compareAttribute'=>'newPassword', 'message' => "Не совпадают поля поролей!"),
			);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'E-mail',
			'newPassword'=>'Новый пароль',
			'verifyPassword'=>'Повторите ввод нового пароля',
		);
	}
	public function afterSave(){
		$subject=Yii::app()->name.' - изменение пароля';
		$message=Settings::getValue('site_user_changePwdHas');
		SiteHelper::mailTo();
	}
	public function checkEmail($attribute,$params){

		$client=Clients::model()->findByAttributes(array('email'=>$this->$attribute));
		if (!$client)
			$this->addError($attribute, "В базе не было найдено пользователя с указаным адресом электронной почты!");
	}
	/**
	 * Verify Old Password
	 */
	 public function beforeSave()
	 {
	 	$this->password=Yii::app()->getModule('user')->encrypting($this->password);
	 	return parent::beforeSave();
	 }
}