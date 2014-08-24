<?php

/**
* This is the model class for table "{{CarModels}}".
*
* The followings are the available columns in table '{{CarModels}}':
    * @property integer $id
    * @property string $name
    * @property integer $brand
*/
class CarModels extends EActiveRecord
{
    public function tableName()
    {
        return '{{CarModels}}';
    }

    public function rules()
    {
        
        return array(
            array('brand, car_type', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, brand, car_type', 'safe', 'on'=>'search'),
        );

    }

    public function relations()
    {
        return array(
            'car_brand' => array(self::BELONGS_TO, 'CarBrands', 'brand'),
            'analog_models' => array(self::HAS_MANY, 'Analogs', 'model_1'),
            'partsCount' => array(self::STAT, 'Parts', 'car_model_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Модель',
            'brand' => 'Марка',
            'car_type'=>'Тип Машины (Легковая/Грузовая)',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('brand',$this->brand);
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
        return 'Модели автомобилей';
    }

    public static function getHtmlOptions()
    {
        return array(
                    'empty'=>'Выберите модель',
                    'class'=>'select',
                    'id'=>'carModels',
                    'name'=>'carModels',
                    ); 
    }

    public static function getCarTypes($status = -1)
    {
        $aliases = array(
            0 => 'Не указано',
            1 => 'Легковая',
            2 => 'Грузовая',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public static function brandModelsList(){
        return Yii::app()->db->createCommand()
            ->select('t1.id, CONCAT(t2.name, " ",t1.name) as name')
            ->from('{{CarModels}} t1')
            ->join('{{CarBrands}} t2', 't2.id=t1.brand')
            // ->where('id=:id', array(':id'=>1))
            ->queryAll();
    }
    
    public static function getAnalogsModels($car_model_id, $category_id){
        
        $analogs = self::findAllModelAnalogs($car_model_id, $category_id);

        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $analogs);

        return self::model()->findAll($criteria);
    }

    /**
     * Рекурсивная функция возвращает массив ID аналогов модели, 
     * относящиеся к определенной категории
     * @param passed - те строки которые прошли
     * @param result - найденные аналоги
     */
    public static function findAllModelAnalogs($car_model_id, $category_id, &$passed = array(), &$result = array()){
        
        // NOT IN 
        $notIn = '';
        if(!empty($passed)) $notIn = ' AND id NOT IN ('.implode(',', $passed).')';

        //По левой стороне
        $analogs = Analogs::model()->findAll('model_1=:m1 AND cat_id=:cat'.$notIn, array(
            ':m1' => $car_model_id, 
            ':cat' => $category_id
        ));
        
        foreach ($analogs as $item) {
            $passed[] = $item->id;
            $result[] = $item->model_2;

            self::findAllModelAnalogs($item->model_2, $category_id, $passed, $result);
        }

        //По правой стороне
        $analogs = Analogs::model()->findAll('model_2=:m2 AND cat_id=:cat'.$notIn, array(
            ':m2' => $car_model_id, 
            ':cat' => $category_id
        ));

        foreach ($analogs as $item) {
            $passed[] = $item->id;
            $result[] = $item->model_1;

            self::findAllModelAnalogs($item->model_1, $category_id, $passed, $result);
        }

        return $result;
    }
}
