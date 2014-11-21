<?php

/**
* This is the model class for table "{{bookpart}}".
*
* The followings are the available columns in table '{{bookpart}}':
    * @property integer $id
    * @property string $name
    * @property string $phone
    * @property string $mail
    * @property string $car_info
    * @property integer $year
    * @property double $capacity
    * @property string $fuel
    * @property string $vin
    * @property string $parts
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Bookpart extends EActiveRecord
{
    public function tableName()
    {
        return '{{bookPart}}';
    }


    public function rules()
    {
        return array(
            array('year, status, sort', 'numerical', 'integerOnly'=>true),
            array('capacity', 'numerical'),
            array('name, phone, mail, car_info, fuel, vin, parts', 'length', 'max'=>255),
            array('create_time, update_time, status', 'safe'),
            // The following rule is used by search().
            array('id, name, phone, mail, car_info, year, capacity, fuel, vin, parts, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
            array('name, phone, mail, car_info, year, capacity, fuel, vin, parts', 'required'),
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
            'name' => 'Ваше имя',
            'phone' => 'Контактный телефон',
            'mail' => 'Электронная почта',
            'car_info' => 'Марка и модель автомобиля',
            'year' => 'Год выпуска автомобиля',
            'capacity' => 'Объем двигателя автомобиля',
            'fuel' => 'Потребляемое топливо',
            'vin' => 'VIN-код автомобиля',
            'parts' => 'Список необходимых деталей',
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
                    'notice'=>array(
                    'class'=>'NoticeBehavior',
                    'noticeMap'=>array(
                        'NoticeAdmin'=>array(
                            'settingName'=>'admin_mail',
                            'fields'=>array(
                                'id'=>false,
                                'status'=>false,
                                'sort'=>false,
                                'create_time'=>false,
                                'update_time'=>false,
                            ),
                        ),
                    ),
                ),
            )
        );
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            0 => 'Не задано', 
            1 => 'Рассмотрено',
            2 => 'Не Рассмотрено',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('car_info',$this->car_info,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('capacity',$this->capacity);
		$criteria->compare('fuel',$this->fuel,true);
		$criteria->compare('vin',$this->vin,true);
		$criteria->compare('parts',$this->parts,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort desc ';
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
        return 'Заказ деталей';
    }


}
