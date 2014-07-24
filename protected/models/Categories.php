<?php

/**
* This is the model class for table "{{Categories}}".
*
* The followings are the available columns in table '{{Categories}}':
    * @property integer $id
    * @property string $name
    * @property integer $parent
    * @property integer $sort
*/
class Categories extends EActiveRecord
{
    public function tableName()
    {
        return '{{categories}}';
    }


    public function rules()
    {
        return array(
            array('parent, sort', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, parent, sort', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'cat_parent' => array(self::BELONGS_TO, 'Categories', 'parent'),
            'children' => array(self::HAS_MANY, 'Categories', 'parent', 'order'=>'name'),
            'partsCount' => array(self::STAT, 'Parts', 'category_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название категории',
            'parent' => 'Родительская категория',
            'sort' => 'Вес для сортировки',
        );
    }

    public static function getHtmlOptions(){
        return array('empty'=>'Выберите подкатегорию', 'id'=>'subCategories','class'=>'select','name'=>'subCategories');
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('sort',$this->sort);
        // $criteria->order = 'parent';
        // $criteria->with = 'children';
        // $criteria->together = true;
        // $criteria->offset = 10;
        // $criteria->limit = 10;
        // $criteria->join = 'LEFT JOIN '.$this->tableName().' as t2 ON t.id=t2.parent';
        // $criteria->addCondition('parent=0');
        // return self::getTree($criteria);
        // $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Категории запчастей';
    }

    public static function getTree($criteria){
        $all = self::model()->findAll($criteria);

        $tree = array();

        return new CArrayDataProvider($all, array(
            'pagination' => false
        ));
    }

    public static function all($criteria=''){

        $data = Yii::app()->db->createCommand()
            ->select('id, name, parent')
            ->from('{{categories}}')
            // ->where('type=1')
            ->queryAll();
        
        foreach ($data as $key => $d) {
            if($d['parent'] != 0) $data[$key]['name'] = "---- ".$d['name'];
        }
        // print_r($data); die();
        // if(!$criteria) $criteria = new CDbCriteria;

        // $criteria->select = 'id, name';
        return $data;
    }

    public function inCookies(){
        $show_array = isset(Yii::app()->request->cookies['show']) ? unserialize(Yii::app()->request->cookies['show']->value) : array();
        return in_array($this->id, $show_array);
    }
}
