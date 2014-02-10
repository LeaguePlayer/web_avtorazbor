<?php

/**
* This is the model class for table "{{Analogs}}".
*
* The followings are the available columns in table '{{Analogs}}':
    * @property integer $id
    * @property integer $model_1
    * @property integer $cat_id
    * @property integer $model_2
*/
class Analogs extends EActiveRecord
{
    public function tableName()
    {
        return '{{Analogs}}';
    }


    public function rules()
    {
        return array(
            array('model_1, cat_id, model_2', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            array('id, model_1, cat_id, model_2', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'cat_id'),
            'model1' => array(self::BELONGS_TO, 'CarModels', 'model_1'),
            'model2' => array(self::BELONGS_TO, 'CarModels', 'model_2'),
            'analog' => array(self::BELONGS_TO, 'CarModels', 'model_2'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'model_1' => 'Модель 1',
            'cat_id' => 'Категория',
            'model_2' => 'Модель 2',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('model_1',$this->model_1);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('model_2',$this->model_2);
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
        return 'Аналоги';
    }


}
