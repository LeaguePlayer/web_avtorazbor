<?php

class DetailController extends FrontController
{
	public $layout = '//layouts/simple';
	public $modelName="Запчасти";
	/**
	 * Declares class-based actions.
	 */
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

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
				'actions'=>array('index','view','parts','AjaxUpdate','disc','addToCart'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
	}
	
	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/detail.js', CClientScript::POS_END);
		$Brand=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		$searchForm=new Search;
		
		if (isset($_GET['Search']))
			$searchForm->attributes=$_GET['Search'];

		$this->render('index',array('Brand'=>$Brand,'searchForm'=>$searchForm));
	}

	public function actionDisc()
	{

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/disc.js', CClientScript::POS_END);
    	$this->breadcrumbs=array('Запчасти'=>'/parts','фильтр');
    	$searchForm=new Search;

    	if (isset($_GET['Search']))
    	{
    		$searchForm->attributes=$_GET['Search'];
    		$searchForm->scenario='disc';
    	}

    	$searchForm->validate();
    	$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');

    	if( !Yii::app()->request->isAjaxRequest )
    	{
    		$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),array(
    				'criteria'=>$searchForm->criteria,
    				'pagination'=>array(
						'pageSize'=>$searchForm->display,
					),
    			)
    		);
			$this->render('disc',array('dataProvider'=>$dataProvider,'searchForm'=>$searchForm));
		}
		else {

			$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),array(
    				'criteria'=>$searchForm->criteria,
    				'pagination'=>array(
						'pageSize'=>$searchForm->display,
					),
    			)
    		);
			print($this->renderPartial('tabParts',array('dataProvider'=>$dataProvider),true));
		}
	}
	
	public function actionParts()
	{
		$cs = Yii::app()->clientScript;
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
	    $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js', CClientScript::POS_END);

		$this->breadcrumbs=array('Запчасти'=>'/parts','фильтр');
		
		$searchForm=new Search;
		$searchForm->scenario= 'parts';

		if (isset($_GET['Search']))
		{
			$searchForm->attributes=$_GET['Search'];
		}

		$searchForm->validate();

		$Countries=CHtml::listData(Country::model()->findAll(),'id','name');
		$Categories=CHtml::listData(Categories::model()->findAll('parent=0'),'id','name');
		$Brands=CHtml::listData(CarBrands::model()->findAll(),'id','name');
		$Models=!empty($searchForm->brand) ? CHtml::listData(CarBrands::model()->findByPk($searchForm->brand)->models,'id','name') : array();

		$subCategories=!empty($searchForm->category_id) ? CHtml::listData(Categories::model()->findAll('parent=:id',array(':id'=>$searchForm->category_id)),'id','name') : array();

		$searchForm->sort='price_sell';

		$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');
		$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),array(
			'criteria'=>$searchForm->criteria,
			'pagination'=>array(
					'pageSize'=>$searchForm->display,
				),
		));

		$this->render('parts',
			array(
				'model'=>$model,
				'Countries'=>$Countries,
				'Brands'=>$Brands,
				'Models'=>$Models,
				'Categories'=>$Categories,
				'subCategories'=>$subCategories,
				'dataProvider'=>$dataProvider,
				'searchForm'=>$searchForm
			));
	}

	public function actionAjaxUpdate()
	{
		if (isset($_GET['Search']))
		{
			$searchForm=new Search;
			$searchForm->attributes=$_GET['Search'];
			$searchForm->scenario='parts';
			$searchForm->validate();
			//die('in controller');
			$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');
			$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),array(
					'criteria'=>$searchForm->criteria,
						'pagination'=>array(
						'pageSize'=>$searchForm->display
					),
				)
			);
			echo $this->renderPartial('//detail/tabParts',array('dataProvider'=>$dataProvider),true);
			die();
		}
	}

	public function actionAddToCart($id)
	{
		if ($id)
		{
			$model=Parts::model()->findByPk($id);
			$cart=Yii::app()->cart;

			if (!$model->inCart())
			{
				$cart->put($model);
			}

			$response['count']=$cart->getItemsCount();
				$response['summ']=$cart->getCost();

				if ($response['count'])
					$response['html']=
							'<ul>
	        				    <li>
	        					<a href="/cart">'+$response['count']+' товар</a>
	        				    </li>
	        				    <li>
	        					На сумму: <strong>'+$response['sum']+' руб.</strong>
	        			     	</li>
	        			  	</ul>';
	        	else 
	        		'<span>товаров нет</span>';

				echo CJSON::encode($response);
				die();
		}
	}

	public function actionView($id)
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/partsView.js', CClientScript::POS_END);

		$model=Parts::model()->findByPk($id);
		$this->model=$model;	
		$brand=$model->car_model->car_brand->id;
		$car_model=$model->car_model->id;
		$category_id=$model->category->id;

		$criteria=Parts::model()->search_parts('model_cat',array('model_id'=>$car_model,'cat_id'=>$category_id));
		$criteria->addCondition('category_id='.$model->category->id);
		$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');
		
		$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),
			array(
				'criteria'=>$criteria,
				'pagination'=>false,
			)
		);
		$this->render('view',array('model'=>$model,'dataProvider'=>$dataProvider,'backToResultUrl'=>$backToResultUrl));
	}


}
