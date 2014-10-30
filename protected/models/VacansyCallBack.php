<?php

/**
* This is the model class for table "{{vacansycallback}}".
*
* The followings are the available columns in table '{{vacansycallback}}':
    * @property integer $id
    * @property string $fio
    * @property string $phone
    * @property string $email
    * @property integer $vacansy_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class VacansyCallBack extends EActiveRecord
{
    public function tableName()
    {
        return '{{vacansyCallBack}}';
    }

    public function rules()
    {
        return array(
            array('vacansy_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('vacansy_id,fio, phone','required'),
            array('fio, phone, email', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, fio, phone, email, vacansy_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'vacansy'=>array(self::BELONGS_TO,'Vacansy','vacansy_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'fio' => 'Ваше фио',
            'phone' => 'Контактный телефон',
            'email' => 'Ваш e-mail',
            'vacansy_id' => 'Претендуемая вакансия',
            'status' => 'Статус',
            'comment'=>'Коментарий',
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
		$criteria->compare('vacansy_id',$this->vacansy_id);
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
        return 'Заявки по вакансиям';
    }


}
