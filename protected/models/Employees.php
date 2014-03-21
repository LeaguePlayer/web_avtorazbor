<?php

/**
* This is the model class for table "{{Employees}}".
*
* The followings are the available columns in table '{{Employees}}':
    * @property integer $id
    * @property string $fio
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
            array('fio', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, fio', 'safe', 'on'=>'search'),
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
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
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
