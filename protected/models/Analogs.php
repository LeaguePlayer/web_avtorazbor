<?php

/**
* This is the model class for table "{{Analogs}}".
*
* The followings are the available columns in table '{{Analogs}}':
    * @property integer $part
    * @property integer $analog
*/
class Analogs extends EActiveRecord
{
    public function tableName()
    {
        return '{{Analogs}}';
    }


    public function rules()
    {
        return array(
            array('part, analog', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            array('part, analog', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'part_analog' => array(self::BELONGS_TO, 'Parts', 'analog')
        );
    }


    public function attributeLabels()
    {
        return array(
            'part' => 'Запчасть',
            'analog' => 'Аналог',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('part',$this->part);
		$criteria->compare('analog',$this->analog);
        
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
        return 'Аналоги';
    }


}
