<?php

/**
* This is the model class for table "{{Documents}}".
*
* The followings are the available columns in table '{{Documents}}':
    * @property integer $id
    * @property string $file
    * @property integer $type
    * @property string $name
    * @property integer $used_car_id
    * @property integer $template_id
    * @property string $create_time
    * @property string $update_time
*/
class Documents extends EActiveRecord
{

    const DOC_KOMISSII = 1;
    const DOC_KUPLI_I_PROD_BU_WITH_KOMISSII = 2;
    const DOC_KUPLI_I_PROD_BU_NO_KOMISSII = 3;

    public function tableName()
    {
        return '{{Documents}}';
    }

    public function rules()
    {
        return array(
            array('type, used_car_id, template_id', 'numerical', 'integerOnly'=>true),
            array('file, name', 'length', 'max'=>255),
            array('sum', 'length', 'max'=>10),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, file, type, name, used_car_id, template_id, sum, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'used_car' => array(self::BELONGS_TO, 'UsedCars', 'used_car_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'file' => 'Файл',
            'type' => 'Тип',
            'name' => 'Название документа',
            'used_car_id' => 'Бу автомобиль',
            'template_id' => 'Шаблон',
            'sum' => 'Сумма',
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
		$criteria->compare('file',$this->file,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('used_car_id',$this->used_car_id);
		$criteria->compare('template_id',$this->template_id);
        $criteria->compare('sum',$this->sum,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

        $criteria->order = 'create_time DESC';

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

    public function getFilePath(){
        if($this->file)
            return Yii::getPathOfAlias('application.docs').DIRECTORY_SEPARATOR.$this->file;
        return '';
    }

    public function getType(){
        $types = self::getTypes();

        return $types[$this->type] ? $types[$this->type] : $types[0];
    }

    public static function getTypeByIndex($index){
        $types = self::getTypes();

        return $types[$index] ? $types[$index] : $types[0];
    }

    public static function getTypes(){

        return array(
            self::DOC_KOMISSII => 'Договор комиссии',
            self::DOC_KUPLI_I_PROD_BU_WITH_KOMISSII => 'Договор купли-продажи ТС к договору комиссии',
            self::DOC_KUPLI_I_PROD_BU_NO_KOMISSII => 'Договор купли и продажи',
        );
    }
}
