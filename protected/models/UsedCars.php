<?php

/**
* This is the model class for table "{{UsedCars}}".
*
* The followings are the available columns in table '{{UsedCars}}':
    * @property integer $id
    * @property integer $car_model_id
    * @property string $vin
    * @property string $price
    * @property integer $comment
    * @property integer $status
*/
class UsedCars extends EActiveRecord
{
    const STATUS_PARTS = 1;
    const STATUS_BUY = 2;
    const STATUS_LIGHT = 1;
    const STATUS_CARGO = 2;

    public function tableName()
    {
        return '{{UsedCars}}';
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_PARTS => 'На запчасти',
            self::STATUS_BUY => 'На продажу',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public static function getExistsData($id,$compareField=null,$selectColumn,$type=1)
    {
        $query=Yii::app()->db->createCommand()
            ->select("distinct($selectColumn) as val")
            ->join('tbl_UsedCar_Info info','info.used_car_id=t.id')
            ->join('tbl_CarModels m','t.car_model_id=m.id')
            ->join('tbl_CarBrands brand','m.brand=brand.id')
            ->join('tbl_country country','country.id=brand.id_country')
            ->from('{{UsedCars}} t')
            ->where( ($id ? "$compareField=$id and t.status=2" : 't.status=2')." and car_type=$type");

        $result=$query->queryAll();
        $data=array();

        foreach ($result as $key => $value) {
            $data[]=$value['val'];
        }
        $criteria=new CDbCriteria;
        if ($data)
            $criteria->addInCondition('id',$data);
        else 
            $criteria->addCondition('id=-1');
        
        return $criteria;
    }

    public static function getYears($year=null)
    {
        $years=array();
        $currYear=(int)date('Y');
        for ($i=$currYear; $i > $currYear-30 ; $i--) { 
            $years[$i]=$i;
        }
        if ($year)
            return $years[$year];
        return $years;
    }

    public static function join()
    {
        return 
                "LEFT JOIN  `tbl_UsedCar_Info` userinfo ON  userinfo.used_car_id =  `t`.id
                LEFT JOIN  `tbl_CarModels` ON  `t`.car_model_id =  `tbl_CarModels`.id
                LEFT JOIN  `tbl_CarBrands` ON  `tbl_CarModels`.brand =  `tbl_CarBrands`.id
                LEFT JOIN  `tbl_country` ON  `tbl_CarBrands`.id_country =  `tbl_country`.id";
    }

    public static final function getBasketList($status = -1){
        
        $aliases = array(
            1 => 'Седан',
            2 => 'Кросровер',
            3 => 'ХетчБэк',
            4 => 'Внедорожник',
            5 => 'Уневерсал',
        );
        
        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

     public static final function getWeightBasketList($status = -1){
        
        $aliases = array(
            6 => 'Фургон',
            7 => 'Тягач',
            8 => 'Прицепы',
            9 => 'Полуприцепы',
            10 => 'Бортовые',
            11 => 'Тентованные',
            12 => 'Цельнометаллические',
            13 => 'Изотермические',
            14 => 'Рефрижераторы',
            15 => 'Самосвалы',
        );
        
        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public static function getCarTypes($status = -1)
    {
        $aliases = array(
            1 => 'Легковая',
            2 => 'Грузовая',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public function rules()
    {
        return array(
            array('car_model_id, vin, name, price, force', 'required'),
            array('car_model_id, status, buyer_id', 'numerical', 'integerOnly'=>true),
            array('name, alias', 'length', 'max'=>255),
            array('vin', 'length', 'max'=>20),
            array('price', 'length', 'max'=>10),
            array('comment, year, enter_date, force, img_preview, bascet', 'safe'),
            // The following rule is used by search().
            array('id, car_model_id, vin, force, price, comment, bascet, status, name, img_preview', 'safe', 'on'=>'search'),
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
                    'medium' => array(
                        'centeredpreview' => array(400, 267),
                    ),
                    'small' => array(
                        'resize' => array(140, 100),
                    )
                ),
            )
        ));
    }

    public function relations()
    {
        return array(
            'dop' => array(self::HAS_ONE, 'UsedCarInfo', 'used_car_id'),
            'owner' => array(self::HAS_ONE, 'Clients', 'used_car_id'),
            'buyer' => array(self::BELONGS_TO, 'Clients', 'buyer_id'),
            'model' => array(self::BELONGS_TO, 'CarModels', 'car_model_id'),
            'part' => array(self::MANY_MANY, 'UsedCars', '{{Parts_UsedCars}}(used_car_id, parts_id)'),
            'document' => array(self::HAS_ONE, 'Documents', 'used_car_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'alias'=>'Алиас',
            'car_model_id' => 'Модель автомобиля',
            'vin' => 'VIN',
            'price' => 'Стоимость покупки',
            'comment' => 'Комментарий',
            'status' => 'Назначение',
            'year' => 'Год выпуска',
            'buyer_id' => 'Покупатель',
            'enter_date' => 'Дата поступления',
            'name' => 'Марка, модель (как в ПТС)',
            'img_preview'=>'фотом машины',
            'bascet'=>'Тип кузова',
            'force'=>'Мощность двигателя (л.с.)'
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('car_model_id',$this->car_model_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('vin',$this->vin,true);
        $criteria->compare('price',$this->price,true);
        $criteria->compare('comment',$this->comment);
        $criteria->compare('status',$this->status);

         $criteria->order = 'enter_date DESC';
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
        return 'Б/У автомобили';
    }

    public static function allCarsForParts(){
        $data = Yii::app()->db->createCommand()
            ->select('id, CONCAT("VIN - ", vin) as name')
            ->from('{{UsedCars}}')
            ->where('status=1')
            ->queryAll();

        return array_merge(array(array('id' => '', 'name' => 'Нет')), $data);
    }

    public function beforeValidate(){
        
        $date = \DateTime::createFromFormat('d.m.Y', $this->enter_date);
        $this->enter_date = $date->format('Y-m-d');

        return parent::beforeValidate();
    }

    public function afterFind(){
        
        if($this->price) $this->price = number_format($this->price, 0, '', '');

        parent::afterFind();
    }

    public function getNameVin(){
        return $this->name.' '.$this->vin;
    }

    public static function toBuyAll(){
        $criteria = new CDbCriteria;

        $criteria->addCondition('status=:s');
        $criteria->params[':s'] = self::STATUS_BUY;

        $criteria->order = 'enter_date DESC';

        return UsedCars::model()->findAll($criteria);
    }

    // public static function 
}