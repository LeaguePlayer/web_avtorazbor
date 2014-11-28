<?php

/**
* This is the model class for table "{{buyout}}".
*
* The followings are the available columns in table '{{buyout}}':
    * @property integer $id
    * @property string $name
    * @property string $phone
    * @property string $email
    * @property integer $brand
    * @property int $car_model_id
    * @property integer $year
    * @property string $capacity
    * @property integer $transmission
    * @property string $comment
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Buyout extends CActiveRecord
{
    
    public function getBrandName()
    {
        return $this->car_brand->name;
    }

    public function getCarModelName()
    {
        return $this->car_model->name;
    }

    public function getTransmissionName()
    {
        return UsedCarInfo::transmissionList($this->transmission);
    }

    public function saveImages(){

    }

    public function tableName()
    {
        return '{{buyout}}';
    }

    public function beforeDelete(){
        parent::beforeDelete();

        $path=Yii::getPathOfAlias('webroot.media.images.buyout').DIRECTORY_SEPARATOR.$this->id.DIRECTORY_SEPARATOR;
        if (is_dir($path))
        {
            if($handle = opendir($path))
            {
                    while(false !== ($file = readdir($handle)))
                            if($file != "." && $file != "..") unlink($path.$file);
                    closedir($handle);
            }
            // $images=unserialize($this->images);
            // if (is_array($images))
            //     foreach ($images as $key => $img) {
            //         if (file_exists($img))
            //             unlink($img);
            //     }
            chmod($path, 0777);
            rmdir($path);
        }

        return true;
    }

    public function rules()
    {
        return array(
            array('brand, year, transmission, car_model_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, phone, email, capacity', 'length', 'max'=>255),
            array('comment, images, brandName,carModelName, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('name, phone, email, car_model_id, year','required'),
            array('phone','match','pattern'=>'/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/','message'=>'Указанный вами номер верен'),
            array('email','match','pattern'=>'/^(\w+\.)*\w+@(\w+\.)+[A-Za-z]+$/','message'=>'Указанный Вами адрес не является адресом электронной почты!'),
            array('id, name, phone, email, brand, car_model_id, year, capacity, transmission, comment, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'car_brand'=>array(self::BELONGS_TO,'CarBrands','brand'),
            'car_model'=>array(self::BELONGS_TO,'CarModels','car_model_id'),
        );
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            0 => 'Не рассморенно',
            1 => 'Рассмотренно',
        );

        if ($status > -1)
            return $aliases[$status];
        if ($status===null)
            return $aliases[0];

        return $aliases;
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Ваше имя',
            'phone' => 'Контактный телефон',
            'email' => 'E-mail',
            'brandName'=>'Марка авто',
            'carModelName'=>'Модель авто',
            'images'=>'Фотографии Вашего автомобиля',
            'transmissionName'=>'Тип КПП',
            'brand' => 'Марка авто',
            'car_model_id' => 'Модель авто',
            'year' => 'Год выпуска',
            'capacity' => 'Объем двигателя',
            'transmission' => 'Тип КПП',
            'comment' => 'Дополнительная ифнормация',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
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
                    'notice'=>array(
                        'class'=>'NoticeBehavior',
                        'type'=>'NoticeAdmin',
                        'noticeMap'=>array(
                            'NoticeAdmin'=>array(
                                'settingName'=>'admin_mail',
                                'fields'=>array(
                                    'id'=>false,
                                    'status'=>false,
                                    'sort'=>false,
                                    'brand'=>false,
                                    'transmission'=>false,
                                    'car_model_id'=>false,
                                    'create_time'=>false,
                                    'update_time'=>false,
                                ),
                            ),
                        ),
                    ),
                )
            );
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('brand',$this->brand);
		$criteria->compare('car_model_id',$this->car_model_id,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('capacity',$this->capacity,true);
		$criteria->compare('transmission',$this->transmission);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort desc';
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
        return 'Выкуп авто';
    }


}
