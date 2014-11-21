<?php

/**
* This is the model class for table "{{diagnostic}}".
*
* The followings are the available columns in table '{{diagnostic}}':
    * @property integer $id
    * @property string $title
    * @property string $alias
    * @property string $phone
    * @property string $img_preview
    * @property string $announce
    * @property string $wswg_body
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Diagnostic extends EActiveRecord
{
    public function tableName()
    {
        return '{{diagnostic}}';
    }

    public function rules()
    {
        return array(
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('title, alias, phone', 'length', 'max'=>255),
            array('img_preview, announce, wswg_body, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('alias','required'),
            array('id, title, alias, phone, img_preview, announce, wswg_body, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'title' => 'Заголовок',
            'alias' => 'Ссылка',
            'phone' => 'Телефон',
            'img_preview' => 'фотка',
            'announce' => 'Превью',
            'wswg_body' => 'Текст',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }

    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'imgBehaviorPreview' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_preview',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('announce',$this->announce,true);
		$criteria->compare('wswg_body',$this->wswg_body,true);
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
        return 'Диагностика - слайдер';
    }

}
