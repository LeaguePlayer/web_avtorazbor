<?php

/**
* This is the model class for table "{{Parts}}".
*
* The followings are the available columns in table '{{Parts}}':
    * @property integer $id
    * @property string $name
    * @property string $price_sell
    * @property string $price_buy
    * @property string $comment
    * @property integer $category_id
    * @property integer $car_model_id
    * @property integer $location_id
    * @property integer $supplier_id
    * @property string $create_time
    * @property integer $status
*/
class Parts extends EActiveRecord
{
    private $_usedCar = false;

    // Статусы в базе данных
    const STATUS_CLOSED = 0;
    const STATUS_PUBLISH = 1;
    const STATUS_REMOVED = 3;
    const STATUS_DEFAULT = self::STATUS_PUBLISH;
    const STATUS_RESERVED = 4;
    const STATUS_UTIL = 5;
    const STATUS_SUCCESS = 6;
    const STATUS_DEVICE = 7;
    const STATUS_RESERVE_DEVICE = 8;

    public $max_sort;
    public $removeOnDelete = true;

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            self::STATUS_CLOSED => 'Не опубликован',
            self::STATUS_PUBLISH => 'Опубликован',
            self::STATUS_REMOVED => 'Удален',
            self::STATUS_RESERVED => 'Зарезервирован',
            self::STATUS_UTIL => 'Утилизирован',
            self::STATUS_SUCCESS => 'Продан',
            self::STATUS_DEVICE => 'Загружено с устройства',
            self::STATUS_RESERVE_DEVICE => 'Зарезервировано для устройства',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public function tableName()
    {
        return '{{Parts}}';
    }


    public function rules()
    {
        return array(
            array('name, price_sell, price_buy', 'required'),
            array('category_id, car_model_id, location_id, supplier_id, status, gallery_id, user_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // array('price_sell, price_buy', 'numerical', 'integerOnly'=>false, 'min' => 1),
            array('price_sell, price_buy', 'length', 'max'=>10),
            array('comment, create_time, update_time, usedCar', 'safe'),
            // The following rule is used by search().
            array('id, name, price_sell, price_buy, comment, category_id, car_model_id, location_id, supplier_id, create_time, update_time, status', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'car_model' => array(self::BELONGS_TO, 'CarModels', 'car_model_id'),
            'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
            'supplier' => array(self::BELONGS_TO, 'Suppliers', 'supplier_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
            //'analogs' => array(self::HAS_MANY, 'Analogs', 'part'),
            'usedCar' => array(self::MANY_MANY, 'UsedCars', '{{Parts_UsedCars}}(parts_id, used_car_id)'),
            'in_util' => array(self::MANY_MANY, 'Requests', '{{CheckUtilization}}(part_id, req_id)')
        );
    }

    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
            'galleryBehaviorGallery' => array(
                'class' => 'appext.imagesgallery.GalleryBehavior',
                'idAttribute' => 'gallery_id',
                'versions' => array(
                    'small' => array(
                        'adaptiveResize' => array(135, 90),
                    ),
                    'medium' => array(
                        'resize' => array(600, 400),
                    ),
                    'normal' => array(
                        'resize' => array(800, 600)
                    ),
                    'big' => array(
                        'resize' => array(1000, 1000)
                    ),
                    'original' => array(
                        'resize' => array(1200)
                    ),
                ),
                'name' => false,
                'description' => false,
            ),
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
            ),
        ));
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'Артикул',
            'name' => 'Название',
            'price_sell' => 'Стоимость (на продажу)',
            'price_buy' => 'Стоимость (покупка)',
            'comment' => 'Комментарий',
            'category_id' => 'Категория',
            'car_model_id' => 'Модель автомобиля',
            'location_id' => 'Склад',
            'supplier_id' => 'Поставщик',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата обновления',
            'status' => 'Статус',
            'gallery_id' => 'Галерея',
            'user_id' => 'Пользователь'
        );
    }

    public function getCommonCriteria(){
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('price_sell',$this->price_sell,true);
        $criteria->compare('price_buy',$this->price_buy,true);
        $criteria->compare('comment',$this->comment,true);
        // $criteria->compare('category_id',$this->category_id);
        // $criteria->compare('car_model_id',$this->car_model_id);
        if($this->location_id != 0) $criteria->compare('location_id',$this->location_id);
        if($this->category_id != 0) {

            $category = Categories::model()->findByPk($this->category_id);
            if($category->parent == 0){
                $children = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('{{categories}}')
                    ->where('parent=:parent', array(':parent'=>$this->category_id))
                    ->queryColumn();
                array_push($children, $this->category_id);
                
                $criteria->addInCondition('category_id', $children);
            }else
                $criteria->compare('category_id', $this->category_id);
        }
        if($this->car_model_id != 0) $criteria->compare('car_model_id',$this->car_model_id);
        $criteria->compare('supplier_id',$this->supplier_id);
        
        if($this->create_time){
            $arr = explode('.', $this->create_time);
            if($arr){
                $date = DateTime::createFromFormat('d.m.Y', $this->create_time);
                $criteria->compare('create_time',$date->format('Y-m-d'),true);
            }
        }
        //$criteria->compare('create_time',$this->create_time,true);

        $criteria->order = 'create_time DESC';

        return $criteria;
    }

    public function utilization(){
        $criteria = $this->getCommonCriteria();
        $criteria->compare('status', self::STATUS_UTIL);

        return new CActiveDataProvider('Parts', array(
            'criteria'=>$criteria,
        ));
    }

    public function deleted(){
        $criteria = $this->getCommonCriteria();
        $criteria->compare('status', self::STATUS_REMOVED);

        return new CActiveDataProvider('Parts', array(
            'criteria'=>$criteria,
        ));
    }

    public function search($pageSize = 10)
    {
        if($pageSize == 'false') 
            $pageSize = false;

        $criteria = $this->getCommonCriteria();
		$criteria->compare('status',$this->status);

        $criteria->addCondition('status!=:status');
        $criteria->params[':status'] = self::STATUS_REMOVED;

        if($this->usedCar){
            // print_r($this->usedCar);
            $criteria->with = 'usedCar';
            $criteria->together = true;
            $criteria->addCondition('usedCar.id=:used_id');
            $criteria->params[':used_id'] = $this->usedCar;
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => $pageSize ? array('pageSize' => $pageSize) : false
        ));
    }

    public function search_analogs($id)
    {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('id', $this->analogsById($id));

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
        return 'Запчасти';
    }

    public function potantialAnalogs(){
        
        $criteria = new CDbCriteria;

        $criteria->select = 't.id, CONCAT( t.name,  " (", cb.name,  " ", cm.name,  ")" ) AS name';
        $criteria->join = 'INNER JOIN {{CarModels}} cm ON `car_model_id`=cm.id INNER JOIN {{CarBrands}} cb ON cm.brand=cb.id';

        if(!$this->isNewRecord){
            $criteria->addCondition('t.id != :id');
            $criteria->params[':id'] = $this->id;
        }

        return self::model()->findAll($criteria);
    }

    /**
     * Get all analogs for current model
     */
    public function analogsById($id){

        $data = Yii::app()->db->createCommand()
            ->select('p.id')
            ->from('{{Analogs}} a')
            ->join('{{Parts}} p', 'p.id = a.analog')
            ->where('a.part = :id', array(':id' => $id))
            ->queryAll();

        $result = array();

        foreach ($data as $d) {
            $result[] = $d['id'];
        }

        return $result;
    }

    public function afterFind(){
        parent::afterFind();

        $this->price_sell = number_format($this->price_sell, 0, '', '');
        $this->price_buy = number_format($this->price_buy, 0, '', '');
    }

    /**
     * Функция возвращает детали относящиеся
     * к одной и той же категории и модели автомобиля
     */
    public function getOwnParts($car_model_id, $cat_id){

        //Находим все аналогичные модели категории
        $analogCarModels = array();
        $analogCarModels[] = $car_model_id; // 1 уровень
        $analogCarModels = array_merge($analogCarModels, CarModels::findAllModelAnalogs($car_model_id, $cat_id)); // 2ой

        $criteria = new CDbCriteria;

        $criteria->addCondition('category_id=:cat_id');
        $criteria->addInCondition('car_model_id', $analogCarModels);

        $criteria->params[':cat_id'] = $cat_id;
        //$criteria->params[':car_model_id'] = $car_model_id;

        if(!$this->isNewRecord){
            $criteria->addCondition('id!=:part_id');
            $criteria->params[':part_id'] = $this->id;
        }

        return new CActiveDataProvider('Parts', array(
            'criteria'=>$criteria,
        ));
    }

    public function afterDelete()
    {
        // Analogs::model()->deleteAll('model_1=:p OR model_2=:p', array(':p' => $this->id));
        // var_dump($this);die();
        parent::afterDelete();

        $db = Yii::app()->db->createCommand();
        $db->delete('{{Parts_UsedCars}}', 'parts_id=:p', array(':p' => $this->id));
        $db->delete('{{CheckUtilization}}', 'part_id=:p', array(':p' => $this->id));
        $db->delete('{{PartsInRequest}}', 'part_id=:p', array(':p' => $this->id));

    }

    public function getUsedCar(){
        return $this->_usedCar;
    }

    public function setUsedCar($val){
        $this->_usedCar = $val;
    }

    public function isAvailable(){
        $statuses = array();

        $statuses[] = self::STATUS_CLOSED;
        $statuses[] = self::STATUS_REMOVED;
        $statuses[] = self::STATUS_RESERVED;
        $statuses[] = self::STATUS_UTIL;
        $statuses[] = self::STATUS_SUCCESS;

        if(in_array($this->status, $statuses))
            return false;

        return true;
    }
}
