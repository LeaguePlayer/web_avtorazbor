<?php

/**
 * This is the model class for table "gallery_photo".
 *
 * The followings are the available columns in table 'gallery_photo':
 * @property integer $id
 * @property integer $gallery_id
 * @property integer $rank
 * @property string $name
 * @property string $description
 * @property string $file_name
 *
 * The followings are the available model relations:
 * @property Gallery $gallery
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryPhoto extends CActiveRecord
{
    /** @var string directory in web root for galleries */
    public $galleryDir = 'media/images';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GalleryPhoto the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        //if ($this->dbConnection->tablePrefix !== null)
        //    return '{{gallery_photo}}';
        //else
            return 'gallery_photo';

    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('gallery_id', 'required'),
//            array('gallery_id, rank', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 512),
            array('file_name', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, gallery_id, rank, name, description, file_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'gallery_id' => 'Gallery',
            'rank' => 'Rank',
            'name' => 'Name',
            'description' => 'Description',
            'file_name' => 'File Name',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('gallery_id', $this->gallery_id);
        $criteria->compare('rank', $this->rank);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('file_name', $this->file_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function save($runValidation = true, $attributes = null)
    {
        parent::save($runValidation, $attributes);
        if ($this->rank == null) {
            $this->rank = $this->id;
            $this->setIsNewRecord(false);
            $this->save(false);
        }
        return true;
    }

    public function getPreview($version = '')
    {
        if($this->gallery->part){
            return Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.$this->galleryDir.DIRECTORY_SEPARATOR."parts".DIRECTORY_SEPARATOR.$this->gallery->part->id.DIRECTORY_SEPARATOR."_".$this->getFileName($version).'.'.$this->ext;
        }

        return Yii::app()->request->baseUrl . '/' . $this->galleryDir . '/_' . $this->getFileName($version) . '.' . $this->ext;
    }

    private function getFileName($version = '')
    {
        return $this->id . $version;
    }

    public function getUrl($version = '')
    {
        return Yii::app()->request->baseUrl . '/' . $this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext;
    }

    public function setImage($path)
    {
        if($this->gallery->part){
            $mediaTypeDir = $this->galleryDir.DIRECTORY_SEPARATOR."parts";
            if(!is_dir($mediaTypeDir))
                mkdir($mediaTypeDir);

            $mediaTypeIdDir = $mediaTypeDir.DIRECTORY_SEPARATOR.$this->gallery->part->id;
            if(!is_dir($mediaTypeIdDir))
                mkdir($mediaTypeIdDir);

            $originalImage = $mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName('original').'.'.$this->ext;

            $image = Yii::app()->phpThumb->create($path);
            $image->resize(1200)->save($originalImage);

            unset($image);

            $image = Yii::app()->phpThumb->create($originalImage);
            //create preview
            $image->resize(300)->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.'_'. $this->getFileName('').'.'.$this->ext);

            foreach ($this->gallery->versions as $version => $actions) {
                if($version == 'original') continue;
                
                $image = Yii::app()->phpThumb->create($originalImage);
                foreach ($actions as $method => $args) {
                    call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                }
                $image->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
            }

        }else{
            /*//save image in original size
            Yii::app()->image->load($path)->save($this->galleryDir . '/' . $this->getFileName('') . '.' . $this->galleryExt);
            //create image preview for gallery manager
            Yii::app()->image->load($path)->resize(300, null)->save($this->galleryDir . '/_' . $this->getFileName('') . '.' . $this->galleryExt);

            foreach ($this->gallery->versions as $version => $actions) {
                $image = Yii::app()->image->load($path);
                foreach ($actions as $method => $args) {
                    call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                }
                $image->save($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->galleryExt);
            }*/
            //save image in original size
            Yii::app()->phpThumb->create($path)->save($this->galleryDir . '/' . $this->getFileName('') . '.' . $this->ext);
            //create image preview for gallery manager
            Yii::app()->phpThumb->create($path)->resize(300)->save($this->galleryDir . '/_' . $this->getFileName('') . '.' . $this->ext);

            foreach ($this->gallery->versions as $version => $actions) {
                $image = Yii::app()->phpThumb->create($path);
                foreach ($actions as $method => $args) {
                    call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                }
                $image->save($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);
            }
        }
    }

    public function delete()
    {
        if($this->gallery->part){
            $mediaTypeDir = $this->galleryDir.DIRECTORY_SEPARATOR."parts";
            if(!is_dir($mediaTypeDir))
                mkdir($mediaTypeDir);

            $mediaTypeIdDir = $mediaTypeDir.DIRECTORY_SEPARATOR.$this->gallery->part->id;
            if(!is_dir($mediaTypeIdDir))
                mkdir($mediaTypeIdDir);

            $this->removeFile($mediaTypeIdDir.DIRECTORY_SEPARATOR."_".$this->getFileName('').'.'.$this->ext);

            foreach ($this->gallery->versions as $version => $actions) {
                $this->removeFile($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
            }
        }else{
            $this->removeFile($this->galleryDir . '/' . $this->getFileName('') . '.' . $this->ext);
            //create image preview for gallery manager
            $this->removeFile($this->galleryDir . '/_' . $this->getFileName('') . '.' . $this->ext);

            foreach ($this->gallery->versions as $version => $actions) {
                $this->removeFile($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);
            }
        }
        
        return parent::delete();
    }

    private function removeFile($fileName)
    {
        if (file_exists($fileName))
            @unlink($fileName);
    }

    public function removeImages()
    {
        if($this->gallery->part){
            $mediaTypeDir = $this->galleryDir.DIRECTORY_SEPARATOR."parts";
            if(!is_dir($mediaTypeDir))
                mkdir($mediaTypeDir);

            $mediaTypeIdDir = $mediaTypeDir.DIRECTORY_SEPARATOR.$this->gallery->part->id;
            if(!is_dir($mediaTypeIdDir))
                mkdir($mediaTypeIdDir);

            foreach ($this->gallery->versions as $version => $actions) {
                if($version == 'original') continue;

                $this->removeFile($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
            }
        }else{
            foreach ($this->gallery->versions as $version => $actions) {
                $this->removeFile($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);
            }
        }
    }

    /**
     * Regenerate image versions
     */
    public function updateImages()
    {
        if($this->gallery->part){

            $mediaTypeDir = $this->galleryDir.DIRECTORY_SEPARATOR."parts";
            if(!is_dir($mediaTypeDir))
                mkdir($mediaTypeDir);

            $mediaTypeIdDir = $mediaTypeDir.DIRECTORY_SEPARATOR.$this->gallery->part->id;
            if(!is_dir($mediaTypeIdDir))
                mkdir($mediaTypeIdDir);

            //old version part images
            $this->removeFile($this->galleryDir . '/_' . $this->getFileName() . '.' . $this->ext);
            foreach ($this->gallery->versions as $version => $actions) {
                $this->removeFile($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);
            }

            //old
            $oldOriginalImage = $this->galleryDir . '/' . $this->getFileName('') . '.' . $this->ext;

            //new
            $newOriginalImage = $mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName('original').'.'.$this->ext;

            if(file_exists($oldOriginalImage)){
                $image = Yii::app()->phpThumb->create($oldOriginalImage);
                $image->resize(1200)->save($newOriginalImage);

                @unlink($oldOriginalImage);
                unset($image);

                $image = Yii::app()->phpThumb->create($newOriginalImage);
                //create preview
                $image->resize(300)->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.'_'. $this->getFileName('').'.'.$this->ext);

                foreach ($this->gallery->versions as $version => $actions) {
                    if($version == 'original') continue;
                    
                    $image = Yii::app()->phpThumb->create($newOriginalImage);
                    foreach ($actions as $method => $args) {
                        call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                    }
                    $image->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
                }
            }else{ //if no Old file

                $newOriginalImage = $mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName('original').'.'.$this->ext;

                /*//remove preview
                $this->removeFile($mediaTypeIdDir.DIRECTORY_SEPARATOR."_".$this->getFileName($version).'.'.$this->ext);

                $image = Yii::app()->phpThumb->create($newOriginalImage);
                //create preview
                $image->resize(300)->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.'_'.$this->getFileName('').'.'.$this->ext);*/

                foreach ($this->gallery->versions as $version => $actions) {
                    if($version == 'original') continue;

                    $this->removeFile($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);

                    $image = Yii::app()->phpThumb->create($newOriginalImage);
                    foreach ($actions as $method => $args) {
                        call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                    }
                    $image->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
                }
            }
/*
            

            

            $image = Yii::app()->phpThumb->create($path);
            $image->resize(1200)->save($originalImage);

            unset($image);

            $image = Yii::app()->phpThumb->create($originalImage);
            //create preview
            $image->resize(300)->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.'_'. $this->getFileName('').'.'.$this->ext);

            foreach ($this->gallery->versions as $version => $actions) {
                if($version == 'original') continue;
                
                foreach ($actions as $method => $args) {
                    call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                }
                $image->save($mediaTypeIdDir.DIRECTORY_SEPARATOR.$this->getFileName($version).'.'.$this->ext);
            }*/

        }else{
            foreach ($this->gallery->versions as $version => $actions) {
                $this->removeFile($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);

                $image = Yii::app()->phpThumb->create($this->galleryDir . '/' . $this->getFileName('') . '.' . $this->ext);
                foreach ($actions as $method => $args) {
                    call_user_func_array(array($image, $method), is_array($args) ? $args : array($args));
                }
                $image->save($this->galleryDir . '/' . $this->getFileName($version) . '.' . $this->ext);
            }
        }
    }
}