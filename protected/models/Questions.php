<?php

/**
* This is the model class for table "{{questions}}".
*
* The followings are the available columns in table '{{questions}}':
    * @property integer $id
    * @property string $name
    * @property string $phone
    * @property string $mail
    * @property string $question
    * @property string $theme
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Questions extends EActiveRecord
{
    public function tableName()
    {
        return '{{questions}}';
    }


    public function rules()
    {
        return array(
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('name, phone, mail, question', 'length', 'max'=>255),
            array('theme, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, phone, mail, question, theme, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
            array('name, phone, mail, question, theme','required'),
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
            'name' => 'Ваше имя',
            'phone' => 'Контактный телефон:',
            'mail' => 'Электронная почта:',
            'question' => 'Ваш вопрос',
            'theme' => 'Тема письма',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('theme',$this->theme,true);
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
        return 'Вопросы';
    }


}
