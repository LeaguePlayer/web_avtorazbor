<?php

/**
* This is the model class for table "{{Locations}}".
*
* The followings are the available columns in table '{{Locations}}':
    * @property integer $id
    * @property string $name
    * @property string $fio
    * @property string $phone
    * @property string $address
*/
class Locations extends EActiveRecord
{
    public function tableName()
    {
        return '{{Locations}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name, fio, phone', 'length', 'max'=>255),
            array('address', 'safe'),
            // The following rule is used by search().
            array('id, name, fio, phone, address', 'safe', 'on'=>'search'),
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
            'name' => 'Название склада',
            'fio' => 'Контактное лицо',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
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
        return 'Склады';
    }

    public static function all($criteria=''){
        return self::model()->findAll($criteria);
    }

    public static function getListForSelect(){
        $data = Yii::app()->db->createCommand()
            ->select('id, name as text')
            ->from('{{Locations}}')
            ->queryAll();

        foreach ($data as $item) {
            $item['id'] = (int) $item['id'];
        }

        return $data;
    }
}
