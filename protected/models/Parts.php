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
    * @property integer $client_id
    * @property string $create_time
    * @property integer $status
*/
class Parts extends EActiveRecord
{
    public function tableName()
    {
        return '{{Parts}}';
    }


    public function rules()
    {
        return array(
            array('name, price_sell', 'required'),
            array('category_id, car_model_id, location_id, client_id, status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('price_sell, price_buy', 'length', 'max'=>6),
            array('comment, create_time', 'safe'),
            // The following rule is used by search().
            array('id, name, price_sell, price_buy, comment, category_id, car_model_id, location_id, client_id, create_time, status', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'car_model' => array(self::BELONGS_TO, 'CarModels', 'car_model_id'),
            'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
            'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            //'analogs' => array(self::HAS_MANY, 'Analogs', 'part'),
            'usedCar' => array(self::MANY_MANY, 'UsedCars', '{{Parts_UsedCars}}(parts_id, used_car_id)'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'price_sell' => 'Стоимость (на продажу)',
            'price_buy' => 'Стоимость (покупка)',
            'comment' => 'Комментарий',
            'category_id' => 'Категория',
            'car_model_id' => 'Модель автомобиля',
            'location_id' => 'Склад',
            'client_id' => 'Поставщик',
            'create_time' => 'Дата создания',
            'status' => 'Статус',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price_sell',$this->price_sell,true);
		$criteria->compare('price_buy',$this->price_buy,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('car_model_id',$this->car_model_id);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('status',$this->status);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
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

    public function beforeSave(){
        
        if($this->isNewRecord)
            $this->create_time = date("Y-m-d H:i:s");

        return parent::beforeSave();
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

    protected function afterDelete()
    {
        parent::afterDelete();

        // Analogs::model()->deleteAll('model_1=:p OR model_2=:p', array(':p' => $this->id));

        $db = Yii::app()->db->createCommand();
        $db->delete('{{Parts_UsedCars}}', 'parts_id=:p', array(':p' => $this->id));
    }
}
