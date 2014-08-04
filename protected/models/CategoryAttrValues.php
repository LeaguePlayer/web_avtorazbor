<?php

/**
* This is the model class for table "{{category_attr_values}}".
*
* The followings are the available columns in table '{{category_attr_values}}':
    * @property integer $id
    * @property integer $attr_id
    * @property string $value
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class CategoryAttrValues extends EActiveRecord
{
    public function tableName()
    {
        return '{{category_attr_values}}';
    }


    public function rules()
    {
        return array(
            array('attr_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('value', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, model_id, attr_id, value, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'attr_id' => 'Характеристика',
            'value' => 'Значение',
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
		$criteria->compare('attr_id',$this->attr_id);
		$criteria->compare('value',$this->value,true);
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


}
