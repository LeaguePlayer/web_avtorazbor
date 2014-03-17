<?php

/**
* This is the model class for table "{{Suppliers}}".
*
* The followings are the available columns in table '{{Suppliers}}':
    * @property integer $id
    * @property string $name
*/
class Suppliers extends EActiveRecord
{
    public function tableName()
    {
        return '{{Suppliers}}';
    }


    public function rules()
    {
        return array(
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name', 'safe', 'on'=>'search'),
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
            'name' => 'ФИО',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
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
        return 'Поставщики';
    }

    public static function getListForSelect(){
        $data = Yii::app()->db->createCommand()
            ->select('id, name as text')
            ->from('{{Suppliers}}')
            ->queryAll();

        foreach ($data as $item) {
            $item['id'] = (int) $item['id'];
        }

        return $data;
    }
}
