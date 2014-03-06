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
    public function tableName()
    {
        return '{{Clients}}';
    }

    public function rules()
    {
        return array(
            array('fio', 'required'),
            array('type', 'numerical', 'integerOnly'=>true),
            array('fio, email', 'length', 'max'=>255),
            array('email', 'email'),
            array('phone', 'length', 'max'=>30),
            // The following rule is used by search().
            array('id, fio, phone, email, type', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'info' => array(self::HAS_ONE, 'ClientsInfo', 'client_id'),
            'bank_accounts' => array(self::HAS_MANY, 'BankAccounts', 'client_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'E-mail',
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

    public static function getTypes(){

        return array(
            1 => 'Физическое лицо',
            2 => 'Юридическое лицо'
        );
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
}
