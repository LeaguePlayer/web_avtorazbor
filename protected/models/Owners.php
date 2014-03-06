<?php

/**
* This is the model class for table "{{Owners}}".
*
* The followings are the available columns in table '{{Owners}}':
    * @property integer $id
    * @property string $fio
    * @property string $dt_birthday
    * @property integer $passport_num
    * @property string $issued_by
    * @property string $address
    * @property string $dt_of_issue
    * @property string $phone
    * @property integer $used_car_id
    * @property string $create_time
    * @property string $update_time
*/
class Owners extends EActiveRecord
{
    public function tableName()
    {
        return '{{Owners}}';
    }


    public function rules()
    {
        return array(
            array('fio, dt_birthday, passport_num, issued_by, address, dt_of_issue', 'required'),
            array('passport_num, used_car_id', 'numerical', 'integerOnly'=>true),
            array('fio, phone', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, fio, dt_birthday, passport_num, issued_by, address, dt_of_issue, phone, used_car_id, create_time, update_time', 'safe', 'on'=>'search'),
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
            'fio' => 'ФИО',
            'dt_birthday' => 'Дата рождения',
            'passport_num' => 'Номер паспорта',
            'issued_by' => 'Кем выдан',
            'address' => 'Адрес регистрации',
            'dt_of_issue' => 'Дата выдачи',
            'phone' => 'Контактный телефон',
            'used_car_id' => 'Бу автомобиль',
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
		$criteria->compare('dt_birthday',$this->dt_birthday,true);
		$criteria->compare('passport_num',$this->passport_num);
		$criteria->compare('issued_by',$this->issued_by,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dt_of_issue',$this->dt_of_issue,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('used_car_id',$this->used_car_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
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
        return 'Владельцы';
    }

	public function beforeSave()
	{
		if (!empty($this->dt_birthday))
			$this->dt_birthday = Yii::app()->date->toMysql($this->dt_birthday);
		if (!empty($this->dt_of_issue))
			$this->dt_of_issue = Yii::app()->date->toMysql($this->dt_of_issue);
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_birthday = ($this->dt_birthday !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_birthday)) : '';
			$this->dt_of_issue = ($this->dt_of_issue !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_of_issue)) : '';
		}
	}
}
