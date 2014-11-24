<?php

/**
* This is the model class for table "{{UsedCar_Info}}".
*
* The followings are the available columns in table '{{UsedCar_Info}}':
    * @property integer $id
    * @property string $price_sell
    * @property integer $year
    * @property string $model_num_engine
    * @property string $chassis_num
    * @property string $carcass_num
    * @property string $color
    * @property string $type_ts
    * @property string $passport_ts
    * @property string $issued_by
    * @property integer $used_car_id
*/
class UsedCarInfo extends EActiveRecord
{
    public function tableName()
    {
        return '{{UsedCar_Info}}';
    }

    public static function getEngineList($engine=null){
        $list=array(1=>'Бензин',2=>'Дизель',3=>"Гибрид");
        
        if ($engine)
            return $list[$engine];
        return $list;
    }

    public function rules()
    {
        return array(
            array('year, privod, engine, used_car_id, mileage, state, transmission', 'numerical', 'integerOnly'=>true),
            array('price_sell', 'length', 'max'=>10),
            array('model_num_engine, chassis_num, carcass_num, color, type_ts, passport_ts', 'length', 'max'=>255),
            array('issued_by,dt_of_issue', 'safe'),
            // The following rule is used by search().
            array('id, price_sell, year, model_num_engine, chassis_num, carcass_num, color, type_ts, passport_ts, issued_by, used_car_id', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }

    public function getPrivodVal(){
        return $this->privod!==null ? self::getPridovList($this->privod) : 'Не указано';
    }

    public static function getPridovList($id=null){
        $list=array(0=>'Задний',1=>'Передний',2=>'Полный');
        return $id ? $list[$id] : $list;
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'price_sell' => 'Стоимость продажи',
            'year' => 'Год выпуска',
            'model_num_engine' => 'Модель, № двигателя',
            'chassis_num' => 'Шасси (Рама) №',
            'carcass_num' => 'Кузов №',
            'color' => 'Цвет',
            'engine'=>'Двигатель',
            'type_ts' => 'Тип ТС',
            'passport_ts' => 'Паспорт ТС',
            'issued_by' => 'Кем выдан',
            'privod'=>'Привод',
            'used_car_id' => 'Б/У автомобиль',
            'mileage' => 'Пробег',
            'state' => 'Состояние',
            'transmission' => 'Тип КПП',
            'dt_of_issue' => 'Дата выдачи'

        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('price_sell',$this->price_sell,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('model_num_engine',$this->model_num_engine,true);
		$criteria->compare('chassis_num',$this->chassis_num,true);
		$criteria->compare('carcass_num',$this->carcass_num,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('type_ts',$this->type_ts,true);
		$criteria->compare('passport_ts',$this->passport_ts,true);
		$criteria->compare('issued_by',$this->issued_by,true);
		$criteria->compare('used_car_id',$this->used_car_id);
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
        return 'Доп опции Б/У автомобиля';
    }

    public static final function statesList(){

        return array(
            1 => 'Идеальное',
            2 => 'Хорошее',
            3 => 'Битая'
        );
    }

    public function getState(){
        $state = self::statesList();

        return $state[$this->state];
    }

    public static final function transmissionList($status=null){
            
        $aliases= array(1 => 'Механика',2 => 'Автоматическая',3 => 'Робот');
        if ($status)
            return $aliases[$status];
        return $aliases;
    }

    

    public function getTransmissionType(){
        $type = self::transmissionList();

        return $type[$this->transmission];
    }

    public function afterFind(){
        
        if($this->price_sell) $this->price_sell = number_format($this->price_sell, 0, '', '');

        parent::afterFind();
    }

    public function beforeValidate(){
        
        if($this->dt_of_issue){
            $date = \DateTime::createFromFormat('d.m.Y', $this->dt_of_issue);
            $this->dt_of_issue = $date->format('Y-m-d');
        }

        return parent::beforeValidate();
    }
}
