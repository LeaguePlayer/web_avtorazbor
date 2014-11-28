<?php

class BuyoutController extends FrontController
{
	public $layout='//layouts/simple';
	public $modelName="Выкуп автомобилей";
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','getModels'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetModels(){

		$models=CarModels::model()->findAll('brand=:brand',array(':brand'=>$_POST['Buyout']['brand']));
		if ($models)
		{
			$models=array('empty'=>'Выберите модель авто')+CHtml::listData($models,'id','name');
			foreach ($models as $value => $name) {

				 echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
			}
			Yii::app()->end();
		}
		echo '<option>Для данного бренда не было найдено автомобилей</option>';
		Yii::app()->end();
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Buyout', $id),
		));
	}
	
	public function actionIndex()
	{
		$model=new Buyout;
		if (isset($_POST['Buyout']))
		{
			$model->attributes=$_POST['Buyout'];
			$images=CUploadedFile::getInstancesByName('images');
			$valid=$model->validate();
			if ($valid)
			{
				$model->save();
				$path=Yii::getPathOfAlias('webroot.media.images.buyout').DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR;
				
				if(!is_dir($path)) {
					   mkdir($path);chmod($path, 0755); 
				}

				$photos=array();
				$sp=DIRECTORY_SEPARATOR;
				$safePath=str_replace(" ", "","$sp media $sp images $sp buyout".$sp.$model->id.$sp);
				
				foreach ($images as $key => $img) {
					$photos[]=$safePath.$img->getName();
					$img->saveAs($path.$img->getName());
				}
				$model->images=serialize($photos);

				$this->redirect(array('/page/thanks'));
			}
		}
		
		$this->render('index',array(
			'model'=>$model,
			'content'=>Page::model()->findByPk(12)->wswg_body,
			)
		);
	}
}
