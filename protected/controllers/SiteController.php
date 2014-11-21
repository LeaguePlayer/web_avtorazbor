<?php

class SiteController extends FrontController
{
	public $layout = '//layouts/simple';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionIndex()
	{
		$searchForm=new Search;
		if (!Yii::app()->request->isAjaxRequest)
		{


			$cs = Yii::app()->clientScript; 
			$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js?v=2', CClientScript::POS_END);
			$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js?v=2', CClientScript::POS_END);
			$Brands=CHtml::listData(CarBrands::model()->findAll(UsedCars::getExistsData(null,null,'brand')),'id','name');

			$BrandsWeightCars=UsedCars::getExistsData(null,null,'brand',2);
			$BrandsParts=CHtml::listData(CarBrands::model()->findAll(Parts::getExistsData(null,null,'brand')),'id','name');
			$BrandsWeightCars=CHtml::listData(CarBrands::model()->findAll($BrandsWeightCars),'id','name');

			$BrandsWeightParts=Parts::getExistsData(null,null,'brand',2);
			$BrandsWeightParts->limit=1;
			$BrandsWeightPartsExists=CHtml::listData(CarBrands::model()->findAll($BrandsWeightParts),'id','name')!=array();
			$Bascet=array();
			$BascetWeight=array();
			$Transmission=array();
			$State=array();
			
			$criteriaCar=new CDbCriteria;
			$criteriaCar->join=Parts::join();
			$criteriaCar->addCondition('car_type=1');
			$criteriaCar->addCondition('status=2');
			$criteriaCar->order='id desc';

			$autoCompliteParts=Yii::app()->db->createCommand()
				->select('name')
				->from('{{Parts}}')
				->queryAll();
			$autoComplite=array();
			foreach ($autoCompliteParts as $key => $value) {
				$autoComplite[]=$value['name'];
			}

			$dataProviderCar=new CActiveDataProvider('UsedCars', array(
				'criteria' => $criteriaCar,
				'pagination'=>false
			));

			$criteriaCars=new CDbCriteria;
			$criteriaCars->order="id desc";
			$criteriaCars->limit="20";
			$criteriaCars->addCondition('status=2');
			
			$criteriaRazbor=new CDbCriteria;
			$criteriaRazbor->limit="20";
			$criteriaRazbor->order="id desc";
			$criteriaRazbor->addCondition('status=1');
			$razbor=new CActiveDataProvider('UsedCars',array(
					'criteria'=>$criteriaRazbor,

				)
			);

			$cars=new CActiveDataProvider('UsedCars',array(
					'criteria'=>$criteriaCars,
				)
			);
			$searchForm->validate();
			$searchForm->criteria->order="t.id desc";

			$this->render('index',
				array(
					'Brands'=>$Brands,
					'autoCompliteParts'=>$autoComplite,
					'BrandsWeightCars'=>$BrandsWeightCars,
					'BrandsParts'=>$BrandsParts,
					'Bascet'=>$Bascet,
					'BrandsWeightPartsExists'=>$BrandsWeightPartsExists,
					'BascetWeight'=>$BascetWeight,
					'Transmission'=>$Transmission,
					'State'=>$State,
					'dataProviderCar'=>$dataProviderCar,
					'searchForm'=>$searchForm,
					'razbor'=>$razbor,'cars'=>$cars,
					'content'=>Page::model()->findByPk(14)->wswg_body,
				)
			);
			
		} else {
			if (isset($_GET['Search']))
			{
				$searchForm->attributes=$_GET['Search'];
				$searchForm->validate();
				$searchForm->criteria->limit=20;
				$searchForm->criteria->select='t.id';
				$model=$_GET['Search']['scenario']=='light' || $_GET['Search']['scenario']=='weight' ? 'UsedCars' : 'Parts';

				$dataProvider=new CActiveDataProvider($model,
					array(
						'criteria'=>$searchForm->criteria,
						'pagination'=>false
					)
				);
				$this->renderPartial('carCarusel',array('dataProvider'=>$dataProvider));
			}
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}