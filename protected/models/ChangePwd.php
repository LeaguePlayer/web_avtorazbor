<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class ChangePwd extends CFormModel {
	public $oldPassword;
	public $password;
	public $verifyPassword;
	
	public function rules() {
		return array(
				array('oldPassword, password, verifyPassword', 'required'),
				array('oldPassword, password, verifyPassword', 'length', 'max'=>128, 'min' => 4,'message' => "Incorrect password (minimal length 4 symbols)."),
				array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Retype Password is incorrect."),
				array('oldPassword', 'verifyOldPassword'),
			);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>'Старый пароль',
			'password'=>'Новый пароль',
			'verifyPassword'=>'Повторите ввод нового пароля',
		);
	}
	
	/**
	 * Verify Old Password
	 */
	 public function verifyOldPassword($attribute, $params)
	 {
		 if (Clients::model()->findByPk(Yii::app()->user->id)->password != Yii::app()->getModule('user')->encrypting($this->$attribute))
		 {
		 	$this->addError($attribute, "Не правильно введен старый пароль!");
			Yii::app()->user->setFlash('error', "Не верный старый пароль!");
		 }
	 }
	 public function beforeSave()
	 {
	 	$this->password=Yii::app()->getModule('user')->encrypting($this->password);
	 	return parent::beforeSave();
	 }
}