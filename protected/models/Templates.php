<?php

/**
* This is the model class for table "{{Templates}}".
*
* The followings are the available columns in table '{{Templates}}':
    * @property integer $id
    * @property string $name
    * @property string $uniqid
    * @property string $file
*/
class Templates extends EActiveRecord
{
    public function tableName()
    {
        return '{{Templates}}';
    }


    public function rules()
    {
        return array(
            array('name, uniqid', 'length', 'max'=>255),
            array('uniqid', 'unique'),
            array('file', 'file', 'allowEmpty' => true, 'types'=>'doc,docx,xls,xlsx'),
            // The following rule is used by search().
            array('id, name, uniqid, file', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'docs' => array(self::HAS_MANY, 'Documents', 'template_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название документа',
            'uniqid' => 'Уникальное название',
            'file' => 'Файл',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('uniqid',$this->uniqid,true);
		$criteria->compare('file',$this->file,true);
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
        return 'Шаблоны документов';
    }

    //save template docs
    private function saveFile(){
        
        if($this->file && $this->file instanceof CUploadedFile){
            
            $pathToTemplates = self::getTemplatePath();

            $filename = $this->uniqid.'.'.$this->file->getExtensionName();
            $this->file->saveAs($pathToTemplates.DIRECTORY_SEPARATOR.$filename);

            return $filename;
        }

        return $this->file ? $this->file : '';
    }

    public function removeTemplateFile(){
        if($this->file){
            $pathToTemplates = self::getTemplatePath();

            @unlink($pathToTemplates.DIRECTORY_SEPARATOR.$this->file);
        }
    }

    public function getTemplatePathToFile(){

        return self::getTemplatePath().DIRECTORY_SEPARATOR.$this->file;
    }

    public static function findTemplateByName($name){
        $model = self::model()->find('uniqid=:uniqid', array(':uniqid' => $name));

        if(!$model)
            throw new Exception('Шаблон - '.$name.' не найден.');

        return $model;
    }

    //get path to templates dir
    public static function getTemplatePath(){
        $pathToDocs = Yii::getPathOfAlias('application.docs');
        $pathToTemplates = Yii::getPathOfAlias('application.docs.templates');

        if(!is_dir($pathToDocs))
            mkdir($pathToDocs, 0777);
        if(!is_dir($pathToTemplates))
            mkdir($pathToTemplates, 0777);

        return $pathToTemplates;
    }

    public static function getDocsPath(){
        $pathToDocs = Yii::getPathOfAlias('application.docs');

        if(!is_dir($pathToDocs))
            mkdir($pathToDocs, 0777);

        return $pathToDocs;
    }

    public function beforeDelete(){

        $this->removeTemplateFile();

        return parent::beforeDelete();
    }

    public function beforeSave(){

        $this->file = $this->saveFile();

        return parent::beforeSave();
    }

    public function afterSave(){
        $event = new CModelEvent($this);
        $this->onChangeFile($event);

        parent::afterSave();
    }

    public function onChangeFile($event) {
        $this->raiseEvent('onChangeFile', $event);
    }

}
