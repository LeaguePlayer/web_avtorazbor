<?php

/**
* This is the model class for table "{{evackuator}}".
*
* The followings are the available columns in table '{{evackuator}}':
    * @property integer $id
    * @property string $name
    * @property string $phone
    * @property string $mail
    * @property string $brand
    * @property string $car_model_id
    * @property string $mass
    * @property double $distance
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Evackuator extends EActiveRecord
{

    private $_brandName;

    public function getBrandName(){
        return $this->Brand->name;
    }

    public function tableName()
    {
        return '{{evackuator}}';
    }


    public function rules()
    {
        return array(
            array('name, phone, brand, modelName','required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('distance', 'numerical'),
            array('mail','match','pattern'=>'/[0-9a-z_]+@[-0-9a-z_^\.]+\.[a-z]{2,3}/i','message'=>'Введенный адрес не является адресмо электронной почты!'),
            array('name, phone, mail, brand, modelName, mass', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, phone, mail, brand, modelName, mass, distance, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'Model'=>array(self::BELONGS_TO,'CarModels','modelName'),
            'Brand'=>array(self::BELONGS_TO,'CarBrands','brand'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Адрес загрузки',
            'phone' => 'Контактный телефон',
            'mail' => 'E-mail',
            'brand' => 'Марка авто',
            'modelName' => 'Модель авто',
            'brandName' => 'Модель авто',
            'mass' => 'Масса авто',
            'distance' => 'КМ',
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
                    'settingName'=>'admin_mail',
                    'fields'=>array(
                        'id'=>false,
                        'status'=>false,
                        'sort'=>false,
                        'brand'=>false,
                        'car_model_id'=>false,
                        'update_time'=>false,
                    ),
                ),
            ),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('modelName',$this->modelName,true);
		$criteria->compare('mass',$this->mass,true);
		$criteria->compare('distance',$this->distance);
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
        return 'Эвакуатор';
    }


}
