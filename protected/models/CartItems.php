<?php

/**
* This is the model class for table "{{cart_items}}".
*
* The followings are the available columns in table '{{cart_items}}':
    * @property integer $id
    * @property integer $cart_id
    * @property integer $part_id
    * @property integer $part_count
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class CartItems extends EActiveRecord
{
    public function tableName()
    {
        return '{{cart_items}}';
    }


    public function rules()
    {
        return array(
            array('cart_id, part_id, part_count, status, sort', 'numerical', 'integerOnly'=>true),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, cart_id, part_id, part_count, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'part'=>array(self::BELONGS_TO,'Parts','part_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'cart_id' => 'Корзина',
            'part_id' => 'Запчасть',
            'part_count' => 'Количество',
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
		$criteria->compare('cart_id',$this->cart_id);
		$criteria->compare('part_id',$this->part_id);
		$criteria->compare('part_count',$this->part_count);
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
        return 'Товары в карзине';
    }


}
