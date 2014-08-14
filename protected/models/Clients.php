<?php

/**
* This is the model class for table "{{Clients}}".
*
* The followings are the available columns in table '{{Clients}}':
    * @property integer $id
    * @property string $fio
    * @property string $phone
    * @property string $email
    * @property integer $type
*/
class Clients extends EActiveRecord
{
    const CLIENT_FIZ = 1;
    const CLIENT_UR = 2;

    public function tableName()
    {
        return '{{Clients}}';
    }

    public function rules()
    {
        return array(
            array('fio', 'required'),
            array('type, used_car_id', 'numerical', 'integerOnly'=>true),
            array('fio, email, passport_num', 'length', 'max'=>255),
            array('email', 'email'),
            array('phone', 'length', 'max'=>30),
            array('dt_birthday, issued_by, address, dt_of_issue', 'safe'),
            // The following rule is used by search().
            array('id, fio, phone, email, type, dt_birthday, passport_num, issued_by, address, dt_of_issue, used_car_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'info' => array(self::HAS_ONE, 'ClientsInfo', 'client_id'),
            'bank_accounts' => array(self::HAS_MANY, 'BankAccounts', 'client_id'),
            'requests'=>array(self::HAS_MANY,'requests','client_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'dt_birthday' => 'Дата рождения',
            'passport_num' => 'Номер паспорта',
            'issued_by' => 'Кем выдан',
            'address' => 'Адрес регистрации',
            'dt_of_issue' => 'Дата выдачи',
            'type' => 'Тип',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('type',$this->type);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Клиенты';
    }

    public static function getTypes($i = -1){

        $types = array(
            self::CLIENT_FIZ => 'Физическое лицо',
            self::CLIENT_UR=> 'Юридическое лицо'
        );

        if($i > 0 && isset($types[$i]))
            return $types[$i];

        return $types;
    }

    public static function getList(){

        $data_fiz = Yii::app()->db->createCommand()
            ->select('id, fio as text')
            ->from('{{Clients}}')
            ->where('type=1')
            ->queryAll();

        $data_ur = Yii::app()->db->createCommand()
            ->select('c.id, ci.name_company as text')
            ->from('{{Clients}} c')
            ->join('{{ClientsInfo}} ci', 'c.id=ci.client_id')
            ->where('type=2')
            ->queryAll();

        $data = array_merge($data_fiz, $data_ur);

        /*$result = array();
        foreach ($data as $d) {
            $result[] = $d['text'];
        }*/
        return $data;
    }

    public function beforeValidate(){
        
        if($this->dt_birthday){
            $date = DateTime::createFromFormat('d.m.Y', (!empty($this->dt_birthday) ? str_replace('-', '', $this->dt_birthday)  : getdate()));
            $this->dt_birthday = $date->format('Y-m-d');
        }
        
        if($this->dt_of_issue){
            $date = \DateTime::createFromFormat('d.m.Y', $this->dt_of_issue);
            $this->dt_of_issue = $date->format('Y-m-d');
        }

        return parent::beforeValidate();
    }
}
