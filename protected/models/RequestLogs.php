<?php

/**
* This is the model class for table "{{RequestLogs}}".
*
* The followings are the available columns in table '{{RequestLogs}}':
    * @property integer $id
    * @property string $message
    * @property integer $user_id
    * @property integer $request_id
    * @property string $create_time
    * @property string $update_time
*/
class RequestLogs extends EActiveRecord
{
    const RL_AUTO = 1;
    const RL_PHONE = 2;
    const RL_COMMENT = 3;

    public function tableName()
    {
        return '{{RequestLogs}}';
    }


    public function rules()
    {
        return array(
            array('message', 'required'),
            array('user_id, request_id, type', 'numerical', 'integerOnly'=>true),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, message, user_id, request_id, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            //'user' => array(self::BELONGS_TO, 'User', 'user_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'message' => 'Сообщение',
            'user_id' => 'Пользователь',
            'request_id' => 'Заявка',
            'type' => 'Тип события',
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
		$criteria->compare('message',$this->message,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('request_id',$this->request_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function types($i = -1){
        $types = array(
            self::RL_AUTO => 'Автоматически',
            self::RL_PHONE => 'Позвонил',
            self::RL_COMMENT => 'Оставил комментарий'
        );

        if($i > 0 && isset($types[$i]))
            return $types[$i];

        return $types;
    }

    public function type(){
        $types = self::types();

        return $types[$this->type];
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Действия с заявками';
    }

    public function getUserName(){
        $user = Yii::app()->db->createCommand()
            ->select('username')
            ->from('{{users}} as u')
            ->where('u.id=:id', array(':id'=>$this->user_id))
            ->queryRow();

        return $user['username'] ? $user['username'] : '';
    }
}
