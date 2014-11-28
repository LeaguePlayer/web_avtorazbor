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
class Parts extends EActiveRecord implements IECartPosition 
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
    const DISC = 16;
    public $max_sort;
    public $removeOnDelete = true;
    public $url;
    public $analog;

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

    function getId(){
        return 'Parts'.$this->id;
    }

    public function inCart()
    {
        return Yii::app()->cart->contains($this->getId());
    }

    function getPrice(){

        return $this->price_sell;
    }

    public function tableName()
    {
        return '{{Parts}}';
    }

    public function afterSave(){
        
        $this->removeAllAttr();
        return parent::afterSave();
    }

    public function removeAllAttr()
    {
        if ($this->id)
        {
            CategoryAttrValues::model()->deleteAll('model_id=:id',array(':id'=>$this->id));
            return true;
        }
        return false;
    }

    public function Disc($min,$max,$category=null)
    {
        $criteria=new CDbCriteria;
        $criteria->join = "inner join `tbl_categories` cat on cat.id=category_id
                           inner join `tbl_category_attr` attr on `attr`.category_id=`t`.category_id
                           inner join `tbl_category_attr_values` attrVal on `attrVal`.attr_id=`attr`.id";
        if ($min)
            $criteria->addCondition('CAST(`attrVal`.value as SIGNED)>='.$min.' and '.'CAST(`attrVal`.value as SIGNED)<='.$max);
            if ($category)
            $criteria->addCondition("cat.id=$category or parent=$category");

        return $criteria;
    }

    public function createName(){

        $cat_name=Yii::app()->db->createCommand()
            ->select('name')
            ->from('{{categories}}')
            ->where('id=:id',array(':id'=>$this->category_id))
            ->queryRow();

        $model=Yii::app()->db->createCommand()
            ->select('t.name,b.name as brand')
            ->from('{{CarModels}} t')
            ->join('{{CarBrands}} b','b.id=t.brand')
            ->where('t.id=:id',array(':id'=>$this->car_model_id))
            ->queryRow();
        $this->name=$cat_name['name'].', '.$model['brand'].' '.$model['name'];

        if (!$this->alias)
            $this->alias=SiteHelper::translit($this->name);
            return $this->name;
    }

    public function rules()
    {
        return array(
            array('price_sell, price_buy', 'required'),
            array('category_id, car_model_id, location_id, supplier_id, status, gallery_id, user_id', 'numerical', 'integerOnly'=>true),
            array('name, alias', 'length', 'max'=>255),
            // array('price_sell, price_buy', 'numerical', 'integerOnly'=>false, 'min' => 1),
            array('price_sell, price_buy', 'length', 'max'=>10),
            array('comment, create_time, update_time, analog, usedCar', 'safe'),
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
                    'view'=>array(
                        'resize' => array(331)
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
            // 'CTimetampBehavior' => array(
            //     'class' => 'zii.behaviors.CTimetampBehavior',
            //     'createAttribute' => 'create_time',
            //     'updateAttribute' => 'update_time',
            // ),
        ));
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'Артикул',
            'name' => 'Название',
            'alias'=>'Алиас',
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

    public static function getExistsData($id,$compareField=null,$selectColumn,$type=1)
    {
        /*
            $id - ид сравниваемой записи;
            $compareField - поле связаной таблицы для сравнения со значением $id;
            $selectColumn - поле которое будет выбираться без повторений
        */
        $query=Yii::app()->db->createCommand()
            ->select("distinct($selectColumn) as val")
            ->join('tbl_CarModels m','t.car_model_id=m.id')
            ->join('tbl_CarBrands brand','m.brand=brand.id')
            ->join('tbl_country country','country.id=brand.id_country')
            ->join('tbl_categories cat','cat.id=category_id')
            ->from('{{Parts}} t')
            ->where( ($id ? "($compareField=$id and status=7) or ($compareField=$id and status=1)" : 'status=7 or status=1')." and car_type=$type");
        
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

    public static function join()
    {
        return 
               "LEFT JOIN  `tbl_CarModels` ON  `t`.car_model_id =  `tbl_CarModels`.id
                LEFT JOIN  `tbl_CarBrands` ON  `tbl_CarModels`.brand =  `tbl_CarBrands`.id
                LEFT JOIN  `tbl_country` ON  `tbl_CarBrands`.id_country =  `tbl_country`.id";
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
        if ($pageSize == 'false')
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
        $this->url=SiteHelper::translit($this->car_model->car_brand->name);
        $this->url.='/'.SiteHelper::translit($this->car_model->name);
        $this->url.='/'.SiteHelper::translit($this->category->name);
    }

    public function getJoin($key)
    {
        $joins=array(
                'brand'=>'
                    inner join {{CarModels}} cr on `cr`.id=`t`.car_model_id
                    inner join {{CarBrands}} cb on `cb`.id=`cr`.brand',
                'car_model_id'=>'inner join {{CarModels}} cr on `cr`.id=`t`.car_model_id',
                'id_country'=>
                    'inner join {{CarBrands}} cb on `cb`.id=`cr`.brand
                     inner join {{country}} c on `c`.id=`cb`.id_country',
                'category_id'=>
                     'inner join {{categories}} ca on `ca`.id=`t`.category_id',
            );
        return $joins[$key];
    }

     public function beforeSave(){
        
        if($this->isNewRecord)
            $this->create_time = date("Y-m-d H:i:s");

        if (!$this->name)
            $this->createName();

        return parent::beforeSave();
    }

// =======
    /**
     * Функция возвращает детали относящиеся
     * к одной и той же категории и модели автомобиля
     */

    public function getPartSearchCriteria($car_model_id, $cat_id,$addCatInCondition=true)
    {

        $analogCarModels = array();
        $analogCarModels[] = $car_model_id; // 1 уровень
        $analogCarModels = array_merge($analogCarModels, CarModels::findAllModelAnalogs($car_model_id, $cat_id)); // 2ой

        $criteria = new CDbCriteria;

        
        $criteria->addInCondition('car_model_id', $analogCarModels);
        if ($addCatInCondition)
        {
            $criteria->params[':cat_id'] = $cat_id;
            $criteria->addCondition('category_id=:cat_id');
        }
        if(!empty($this->id)){
            $criteria->addCondition('id!=:part_id');
            $criteria->params[':part_id'] = $this->id;
        }

        return $criteria;
    }

    public function getOwnParts($car_model_id, $cat_id){

        //Находим все аналогичные модели категории
        $criteria=$this->getPartSearchCriteria($car_model_id, $cat_id);
        return new CActiveDataProvider('Parts', array(
            'criteria'=>$criteria,
        ));
    }

    public function findAllModelsWithAnalogs($model_id)
    {

        $categories = Yii::app()->db->createCommand()
            ->select('distinct(part.category_id)')
            ->from('{{Parts}} part')
            ->join('{{categories}} c','c.parent!=0')
            ->where('part.car_model_id = :id', array(':id' => $model_id))
            ->queryAll();
        
        $data=array();
        $modelCategory=array();
        foreach ($categories as $key => $cat_id) {

            $subCriteria=$this->getPartSearchCriteria($model_id,$cat_id['category_id']);
            $models=$this->findAll($subCriteria);

            foreach($models as $key=>$value)
            {
                $data[$value->car_model_id]=$value->car_model_id;
                $modelCategory[$value->category_id]=$value->category_id;
            }
        }

        $criteria=new CDbCriteria;
        if ($data)
        {
            $criteria->addInCondition('car_model_id',$data);
            $criteria->addInCondition('category_id',$modelCategory);
            //$criteria->addInCondition('parent',$modelCategory,'or');
        }

        $result['criteria']=$criteria;
        $result['models']=$data;
        $result['categories']=$modelCategory;

        return $result;
    }

    public function getModelsByCountry($country_id,$pagination=false, $car_type=1)
    {

        $criteria=new CDbCriteria;
        $criteria->addCondition('id_country='.$country_id);
        $criteria->addCondition('car_type='.$car_type);
        // $countryBrands=Yii::app()->db->createCommand()
        //     ->select('cb.id')
        //     ->from('{{CarBrands}} cb')
        //     ->where('cb.id_country = :id', array(':id' => $country_id))
        //     ->queryAll();

        // $brandModels=array();
        // $data=array();
        // $modelCategory=array();
        // foreach ($countryBrands as $key => $value) {

        //     $result=$this->getModelsByBrand($value['id'],$pagination);

        //     // $models=Parts::model()->findAll($subCriteria);
        //     $data=array_merge($data,$result['models']);
        //     $modelCategory=array($modelCategory,$result['categories']);
        // }
        // if ($data)
        // {
        //     $criteria->addInCondition('car_model_id',$data);
        //     $criteria->addInCondition('category_id',$modelCategory);
        //     $criteria->addInCondition('parent',$modelCategory);
        // }
            
        // else 
        //     $criteria->addCondition('car_model_id=0');
        return $criteria;
    }

    public function getModelAnalogCategories($model_id)
    {
         return $brandModels = Yii::app()->db->createCommand()
                ->select('a.cat_id')
                ->from('{{analogs}} a')
                ->where('a.model_1 = :id or a.model_2=:id', array(':id' => $model_id))
                ->queryAll();
    }

    public function getModelsByBrand($brand_id,$pagination=false, $car_type=1)
    {

        $criteria=new CDbCriteria;

            // $brandModels = Yii::app()->db->createCommand()
            //     ->select('cm.id')
            //     ->from('{{CarModels}} cm')
            //     ->leftJoin('{{CarBrands}} cb','cb.id = cm.brand')
            //     ->where('cm.brand = :id', array(':id' => $brand_id))
            //     ->queryAll();
        $criteria->addCondition('brand='.$brand_id);
        //$criteria->addCondition('car_type='.$car_type);
        $criteria->join=$this->getJoin('brand');
        // $data=array();
        // $modelCategory=array();
        // foreach ($brandModels as $key => $model) {

        //     $result=$this->findAllModelsWithAnalogs($model['id']);

        //     if (!empty($result['models']))
        //     {
        //         $data=array_merge($data,$result['models']);
        //         $modelCategory=array_merge($modelCategory,$result['categories']);
        //     }
        // }

        // if ($data)
        // {
        //     $criteria->addInCondition('car_model_id',$data);
        //     $criteria->addInCondition('category_id',$modelCategory);
        //     //$criteria->addInCondition('parent',$modelCategory,'or');
        // }
        // else 
        //     $criteria->addCondition('car_model_id=0');

        $result['criteria']=$criteria;
        $result['models']=$data;
        $result['categories']=$modelCategory;

        return $result;
    }

    public function search_parts($searchType,$value)
    {
        $criteria=new CDbCriteria;

        $criteria->join=
            $this->getJoin('category_id');

        switch ($searchType) {
            case 'id_country':
                {
                    $criteria->join.=' '.$this->getJoin('car_model_id');
                    $criteria->join.=' '.$this->getJoin('id_country');
                    $criteria->mergeWith($this->getModelsByCountry($value));
                    return $criteria;
                }
                break;
            case 'brand':
                {   
                    $result=$this->getModelsByBrand($value);
                    $criteria->mergeWith($result['criteria']);
                   
                    return $criteria;
                }
                break;
            case 'car_model_id':
                {

                    $result=$this->findAllModelsWithAnalogs($value);
                    $criteria->join.=' '.$this->getJoin('car_model_id');
                    $criteria->mergeWith($result['criteria']);
                    return $criteria;
                }
                break;
            case 'model_cat':
                {
                    $result=$this->findAllModelsWithAnalogs($value['model_id']);
                    $criteria->join.=' '.$this->getJoin('car_model_id');
                    $criteria->mergeWith($result['criteria']);

                    return $criteria;
                }
            break;
            default:
                {
                    //$criteria->join.=' '.$this->getJoin('car_model_id');
                    return new CDbCriteria;
                }
                break;
        }
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
