<?php

/**
* This is the model class for table "{{BankAccounts}}".
*
* The followings are the available columns in table '{{BankAccounts}}':
    * @property integer $id
    * @property string $bank
    * @property string $num_account
    * @property string $bik
    * @property string $korr
    * @property string $city
    * @property integer $client_id
*/
class BankAccounts extends EActiveRecord
{
    public function tableName()
    {
        return '{{BankAccounts}}';
    }


    public function rules()
    {
        return array(
            array('bank, num_account, bik', 'required'),
            array('client_id', 'numerical', 'integerOnly'=>true),
            array('bank, num_account, bik, korr, city', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, bank, num_account, bik, korr, city, client_id', 'safe', 'on'=>'search'),
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
            'bank' => 'Банк',
            'num_account' => '№ счета',
            'bik' => 'БИК банка',
            'korr' => 'Корр. счет',
            'city' => 'Город',
            'client_id' => 'Клиент',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('num_account',$this->num_account,true);
		$criteria->compare('bik',$this->bik,true);
		$criteria->compare('korr',$this->korr,true);
		$criteria->compare('city',$this->city,true);
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
        return 'Счета';
    }


}
