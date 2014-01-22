<?php

/**
* This is the model class for table "{{Locations}}".
*
* The followings are the available columns in table '{{Locations}}':
    * @property integer $id
    * @property string $name
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
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name', 'safe', 'on'=>'search'),
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
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
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
}
