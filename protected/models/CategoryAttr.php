<?php

/**
* This is the model class for table "{{category_attr}}".
*
* The followings are the available columns in table '{{category_attr}}':
    * @property integer $id
    * @property integer $category_id
    * @property string $attr
    * @property integer $type
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class CategoryAttr extends EActiveRecord
{
    public function tableName()
    {
        return '{{category_attr}}';
    }


    public function rules()
    {
        return array(
            array('category_id, type, status, sort', 'numerical', 'integerOnly'=>true),
            array('attr', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, category_id, attr, type, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'attrValue'=>array(self::HAS_ONE,'CategoryAttrValues','attr_id')
        );
    }

    public function getValue($id=null)
    {
        if (empty($id))
            return '';
        else 
            {

                $catAttValue=CategoryAttrValues::model()->find('attr_id=:attr and model_id=:model_id',array(':attr'=>$this->id,':model_id'=>$id));
                return $catAttValue->value;
            }            
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => 'Комментарий',
            'attr' => 'Характеристика',
            'type' => 'тип поля',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('attr',$this->attr,true);
		$criteria->compare('type',$this->type);
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
