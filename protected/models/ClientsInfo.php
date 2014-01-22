<?php

/**
* This is the model class for table "{{ClientsInfo}}".
*
* The followings are the available columns in table '{{ClientsInfo}}':
    * @property integer $id
    * @property string $inn
    * @property string $kpp
    * @property string $bank
    * @property string $num_account
    * @property string $name_company
    * @property string $address
    * @property integer $client_id
*/
class ClientsInfo extends EActiveRecord
{
    public function tableName()
    {
        return '{{ClientsInfo}}';
    }


    public function rules()
    {
        return array(
            array('inn', 'required'),
            array('client_id', 'numerical', 'integerOnly'=>true),
            array('inn, kpp', 'length', 'max'=>20),
            array('bank, num_account, name_company, address', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, inn, kpp, bank, num_account, name_company, address, client_id', 'safe', 'on'=>'search'),
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
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'bank' => 'Банк',
            'num_account' => '№ счета',
            'name_company' => 'Название компании',
            'address' => 'Адрес',
            'client_id' => 'Клиент',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('inn',$this->inn,true);
		$criteria->compare('kpp',$this->kpp,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('num_account',$this->num_account,true);
		$criteria->compare('name_company',$this->name_company,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('client_id',$this->client_id);
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
        return 'Реквизиты';
    }


}
