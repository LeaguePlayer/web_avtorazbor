<?php

/**
* This is the model class for table "{{CarBrands}}".
*
* The followings are the available columns in table '{{CarBrands}}':
    * @property integer $id
    * @property string $name
*/
class CarBrands extends EActiveRecord
{
    public function tableName()
    {
        return '{{CarBrands}}';
    }


    public function rules()
    {
        return array(
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name,id_country', 'safe', 'on'=>'search'),
            array('name, id_country', 'required'),
        );
    }

    public static function getHtmlOptions()
    {
       return array('empty'=>'Выберите марку',
                    'class'=>'select nested',
                    'data-nested'=>'#carModels', 
                    'data-column'=>'brand', 
                    'id'=>'carBrands',
                    'name'=>'carBrands',
                    'onChange'=>'setNestedSelect.apply(this,[]);'
                );
    }

    public static function AjaxOptions(){
        return array(
                'dataType'=>'json',
                'type'=>'get',
                'url'=>'/ajaxRequests/detail',
                'data'=>'js:this.value',
                'success'=>'function(data){
                    $("#carModels").closest("dd").empty(data.select);
                    $("#carModels").selectbox();
                }',
                'error'=>'function(){
                    alert("Ошибка сервера! пожалуйста повторите попытку позднее!");
                }'
            );
    }

    public function relations()
    {
        return array(
            'models' => array(self::HAS_MANY, 'CarModels', 'brand')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Марка',
            'id_country' => 'Страна производитель',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

        $criteria->order = 'name';
        
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
        return 'Марки автомобилей';
    }


}
