<?php

/**
* This is the model class for table "{{front_user}}".
*
* The followings are the available columns in table '{{front_user}}':
    * @property integer $id
    * @property string $username
    * @property string $password
    * @property string $company
    * @property string $okpo
    * @property string $inn
    * @property string $city
    * @property string $phone
    * @property string $adres
    * @property string $email
    * @property string $subscribe_mail
    * @property string $subscribe_sms
    * @property string $mail_adres
    * @property string $phiz_adres
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class FrontUser extends EActiveRecord
{
    public function tableName()
    {
        return '{{front_user}}';
    }

    public function rules()
    {
        return array(
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('username, password, company, okpo, inn, city, tel, adres, email, subscribe_mail, subscribe_sms, mail_adres, phiz_adres', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, username, password, company, okpo, inn, city, tel, adres, email, subscribe_mail, subscribe_sms, mail_adres, phiz_adres, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'fio' => 'ФИО',
            'company' => 'Компания',
            'okpo' => 'ОКПО',
            'inn' => 'ИНН',
            'city' => 'Город',
            'tel' => 'телефон',
            'adres' => 'адрес доставки',
            'email' => 'Почта',
            'subscribe_mail' => 'Подписаться на e-mail рассылку',
            'subscribe_sms' => 'Подписаться на sms рассылку',
            'mail_adres' => 'Почтовый адрес',
            'phiz_adres' => 'физический адрес',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
            
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('okpo',$this->okpo,true);
		$criteria->compare('inn',$this->inn,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('adres',$this->adres,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('subscribe_mail',$this->subscribe_mail,true);
		$criteria->compare('subscribe_sms',$this->subscribe_sms,true);
		$criteria->compare('mail_adres',$this->mail_adres,true);
		$criteria->compare('phiz_adres',$this->phiz_adres,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function beforeSave()
    {
        if (!empty($this->password) && strlen($this->password)!=32)
            $this->password=Yii::app()->getModule('user')->encrypting($this->password);
        parent::beForeSave();
        return true;

    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Пользователь сайта';
    }


}
