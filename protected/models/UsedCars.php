<?php

/**
* This is the model class for table "{{UsedCars}}".
*
* The followings are the available columns in table '{{UsedCars}}':
    * @property integer $id
    * @property integer $car_model_id
    * @property string $vin
    * @property string $price
    * @property integer $comment
    * @property integer $status
*/
class UsedCars extends EActiveRecord
{
    // Статусы в базе данных
    const STATUS_PARTS = 1;
    const STATUS_BUY = 2;

    public function tableName()
    {
        return '{{UsedCars}}';
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_PARTS => 'На запчасти',
            self::STATUS_BUY => 'На продажу',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }


    public function rules()
    {
        return array(
            array('car_model_id, vin', 'required'),
            array('car_model_id, status', 'numerical', 'integerOnly'=>true),
            array('vin', 'length', 'max'=>20),
            array('price', 'length', 'max'=>10),
            array('comment', 'safe'),
            // The following rule is used by search().
            array('id, car_model_id, vin, price, comment, status', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'dop' => array(self::HAS_ONE, 'UsedCarInfo', 'used_car_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'car_model_id' => 'Модель автомобиля',
            'vin' => 'VIN',
            'price' => 'Стоимость покупки',
            'comment' => 'Комментарий',
            'status' => 'Назначение',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('car_model_id',$this->car_model_id);
        $criteria->compare('vin',$this->vin,true);
        $criteria->compare('price',$this->price,true);
        $criteria->compare('comment',$this->comment);
        $criteria->compare('status',$this->status);
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
        return 'Б/У автомобили';
    }


}