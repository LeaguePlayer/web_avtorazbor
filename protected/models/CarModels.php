<?php

/**
* This is the model class for table "{{CarModels}}".
*
* The followings are the available columns in table '{{CarModels}}':
    * @property integer $id
    * @property string $name
    * @property integer $brand
*/
class CarModels extends EActiveRecord
{
    public function tableName()
    {
        return '{{CarModels}}';
    }


    public function rules()
    {
        return array(
            array('brand', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, brand', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'car_brand' => array(self::BELONGS_TO, 'CarBrands', 'brand')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Модель',
            'brand' => 'Марка',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('brand',$this->brand);
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
        return 'Модели автомобилей';
    }

    public static function brandModelsList(){
        return Yii::app()->db->createCommand()
            ->select('t1.id, CONCAT(t2.name, " ",t1.name) as name')
            ->from('{{CarModels}} t1')
            ->join('{{CarBrands}} t2', 't2.id=t1.brand')
            // ->where('id=:id', array(':id'=>1))
            ->queryAll();
    }
}
