<?php

/**
* This is the model class for table "{{Employees}}".
*
* The followings are the available columns in table '{{Employees}}':
    * @property integer $id
    * @property string $fio
    * @property string $phone
    * @property string $email
    * @property string $dt_birthday
    * @property string $passport_num
    * @property string $issued_by
    * @property string $address
    * @property string $dt_of_issue
*/
class Employees extends EActiveRecord
{
    public function tableName()
    {
        return '{{Employees}}';
    }


    public function rules()
    {
        return array(
            array('fio', 'required'),
            array('fio, email, passport_num, post', 'length', 'max'=>255),
            array('phone', 'length', 'max'=>30),
            array('email', 'email'),
            array('dt_birthday, issued_by, address, dt_of_issue', 'safe'),
            // The following rule is used by search().
            array('id, fio, phone, email, dt_birthday, passport_num, issued_by, address, dt_of_issue', 'safe', 'on'=>'search'),
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
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'dt_birthday' => 'Дата рождения',
            'passport_num' => 'Номер паспорта',
            'issued_by' => 'Кем выдан',
            'address' => 'Адрес регистрации',
            'dt_of_issue' => 'Дата выдачи',
            'post' => 'Должность'
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dt_birthday',$this->dt_birthday,true);
		$criteria->compare('passport_num',$this->passport_num,true);
		$criteria->compare('issued_by',$this->issued_by,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dt_of_issue',$this->dt_of_issue,true);
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
        return 'Сотрудники';
    }

	public function beforeSave()
	{
		if (!empty($this->dt_birthday)){
            $date = new DateTime($this->dt_birthday);
            $this->dt_birthday = $date->format('Y-m-d H:i:s');
        }
			//$this->dt_birthday = Yii::app()->date->toMysql($this->dt_birthday);
		if (!empty($this->dt_of_issue)){
            $date = new DateTime($this->dt_of_issue);
            $this->dt_of_issue = $date->format('Y-m-d H:i:s');
        }
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_birthday = ($this->dt_birthday && $this->dt_birthday !== '0000-00-00' ) ? date('d.m.Y', strtotime($this->dt_birthday)) : '';
			$this->dt_of_issue = ($this->dt_of_issue && $this->dt_of_issue !== '0000-00-00' ) ? date('d.m.Y', strtotime($this->dt_of_issue)) : '';
		}
	}

    public static function getListForSelect(){
        $data = Yii::app()->db->createCommand()
            ->select('id, fio as text')
            ->from('{{Employees}}')
            ->queryAll();

        foreach ($data as $item) {
            $item['id'] = (int) $item['id'];
        }

        return $data;
    }
}
