<?php

/**
* This is the model class for table "{{Documents}}".
*
* The followings are the available columns in table '{{Documents}}':
    * @property integer $id
    * @property string $file
    * @property integer $type
*/
class Documents extends EActiveRecord
{
    public function tableName()
    {
        return '{{Documents}}';
    }


    public function rules()
    {
        return array(
            array('type', 'numerical', 'integerOnly'=>true),
            array('file', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, file, type', 'safe', 'on'=>'search'),
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
            'file' => 'Файл',
            'type' => 'Тип',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('type',$this->type);
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
        return 'Документы';
    }


}
