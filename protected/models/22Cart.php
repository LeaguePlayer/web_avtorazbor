<?php

/**
* This is the model class for table "{{cart}}".
*
* The followings are the available columns in table '{{cart}}':
    * @property integer $id
    * @property string $dt_book
    * @property string $dt_pay
    * @property integer $user_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class 22Cart extends EActiveRecord
{
    public function tableName()
    {
        return '{{cart}}';  
    }
    
    public function rules()
    {
        return array(
            array('user_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('dt_book, dt_pay, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, dt_book, dt_pay, user_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }

    public function getItemsSearch()
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('cart_id='.$this->id);

        return new CActiveDataProvider('CartItems',array(
                'criteria'=>$criteria
            )
        );
    }

    public function relations()
    {
        return array(
            'cart'=>array(self::HAS_MANY,'cart_items','cart_id'),
        );
    }

    public function beforeDelete()
    {
        CartItems::model()->deleteAll(array('cart_id='.$this->id));
        return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'dt_book' => 'дата заказа',
            'dt_pay' => 'дата оплаты',
            'user_id' => 'дата оплаты',
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
		$criteria->compare('dt_book',$this->dt_book,true);
		$criteria->compare('dt_pay',$this->dt_pay,true);
		$criteria->compare('user_id',$this->user_id);
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
        return 'Корзина';
    }

	public function beforeSave()
	{
		if (!empty($this->dt_book))
			$this->dt_book = Yii::app()->date->toMysql($this->dt_book);
		if (!empty($this->dt_pay))
			$this->dt_pay = Yii::app()->date->toMysql($this->dt_pay);
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_book = ($this->dt_book !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_book)) : '';
			$this->dt_pay = ($this->dt_pay !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_pay)) : '';
		}
	}
}
