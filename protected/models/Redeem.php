<?php

/**
* This is the model class for table "{{redeem}}".
*
* The followings are the available columns in table '{{redeem}}':
    * @property integer $id
    * @property string $fio
    * @property string $phone
    * @property string $email
    * @property integer $brand
    * @property string $model_name
    * @property integer $year
    * @property string $capacity
    * @property string $transmission
    * @property string $comment
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Redeem extends EActiveRecord
{
    public function tableName()
    {
        return '{{redeem}}';
    }


    public function rules()
    {
        return array(
            array('brand, year, status, sort', 'numerical', 'integerOnly'=>true),
            array('fio, phone, email, model_name, capacity', 'length', 'max'=>255),
            array('transmission, comment, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, fio, phone, email, brand, model_name, year, capacity, transmission, comment, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'fio' => 'Ваше имя',
            'phone' => 'Контактный телефон',
            'email' => 'E-mail',
            'brand' => 'Марка авто',
            'model_name' => 'Модель автомобиля',
            'year' => 'Год выпуска',
            'capacity' => 'Год выпуска',
            'transmission' => 'Тип кпп',
            'comment' => 'Год выпуска',
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('brand',$this->brand);
		$criteria->compare('model_name',$this->model_name,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('capacity',$this->capacity,true);
		$criteria->compare('transmission',$this->transmission,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
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
        return 'Выкуп авто';
    }


}
