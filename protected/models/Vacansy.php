<?php

/**
* This is the model class for table "{{vacansy}}".
*
* The followings are the available columns in table '{{vacansy}}':
    * @property integer $id
    * @property string $post
    * @property string $desc
    * @property string $wswg_body
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Vacansy extends EActiveRecord
{
    public function tableName()
    {
        return '{{vacansy}}';
    }


    public function rules()
    {
        return array(
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('post', 'length', 'max'=>255),
            array('desc, wswg_body, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, post, desc, wswg_body, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'post' => 'Должность',
            'desc' => 'Анонс',
            'wswg_body' => 'Описание',
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
		$criteria->compare('post',$this->post,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('wswg_body',$this->wswg_body,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort desc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public function scopes()
    {
        return array(
                'pulbished'=>array(
                    'condition'=>'status=1'
                )
            );
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Вакансии';
    }


}
