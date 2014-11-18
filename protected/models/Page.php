<?php

/**
* This is the model class for table "{{page}}".
*
* The followings are the available columns in table '{{page}}':
    * @property integer $id
    * @property string $img_preview
    * @property string $name
    * @property string $alias
    * @property string $description
    * @property string $wswg_body
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Page extends EActiveRecord
{
    public $marks=array( 'News'=>'news-news','news-company',);
    public $statusBefore;
    public function tableName()
    {
        return '{{page}}';
    }

    public function afterFind(){
        parent::beforeFind();

        $this->statusBefore=$this->status;

        return true;
    }

    public function beforeSave(){
        parent::beforeSave();
        if ($this->statusBefore==4)
            $this->status=4;
        return true;
    }

    public function rules()
    {
        return array(
            array('name,alias,wswg_body','required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('name, alias', 'length', 'max'=>255),
            array('img_preview, description, wswg_body, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, img_preview, name, alias, description, wswg_body, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function replaceMart($mark)
    {
        foreach ($this->marks as $key => $mark) {
            if (!is_array($mark))
            {
                if (strpos($this->wswg_body,$mark))
                    $this->wswg_body=str_replace($this->wswg_body, replace, subject);
            }
        }
    }

    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'img_preview' => 'Фото',
            'name' => 'Заголовок',
            'alias' => 'Алиас',
            'description' => 'Краткое описание',
            'wswg_body' => 'Контент',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
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
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
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
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('wswg_body',$this->wswg_body,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
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
        return 'Страницы';
    }


}
