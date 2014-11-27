<?php

class DetailController extends FrontController
{
	public $layout = '//layouts/simple';
	public $modelName="Каталог Автозапчастей";
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
				'actions'=>array('index','view','parts','AjaxUpdate','disc','addToCart','testApi'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),	
		);
	}

	public function actionTestApi($id){
		
		$model=Parts::model()->findByPk($id);

		$this->render('testApi',array('model'=>$model));
	}

	public function actionIndex()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/detail.js?v=2', CClientScript::POS_END);
		$Brands=Parts::getExistsData(null,null,'brand');

		$Brand=CHtml::listData(CarBrands::model()->findAll($Brands),'id','name');
		$WeightBrand=CHtml::listData(CarBrands::model()->findAll(Parts::getExistsData(null,null,'brand',2)),'id','name');
		$searchForm=new Search;
		
		if (isset($_GET['Search']))
		{
			$searchForm->attributes=$_GET['Search'];
		}
		
		$Brands=CHtml::listData(
					CarBrands::model()
						->findAll(
							Parts::getExistsData(
								null,
								null,
								'brand',
								$searchForm->type)
						)
					,'id','name');
		$Models=CHtml::listData(
					CarModels::model()->findAll(
						Parts::getExistsData(
							$searchForm->brand,
							'brand',
							'car_model_id',
							$searchForm->type)
						),
					'id','name'
				);
		$Categories=CHtml::listData(
				Categories::model()->findAll(
					Parts::getExistsData(
						$searchForm->car_model_id,
						'car_model_id',
						'parent',
						$searchForm->type)
					),
				'id','name'
			);

		$subCategories=CHtml::listData(
				Categories::model()->findAll(
					Parts::getExistsData(
						$searchForm->car_model_id,
						'car_model_id',
						'category_id',
						$searchForm->type)
					),
				'id','name'
			);
		$this->title=$this->modelName;
		Yii::app()->clientScript->registerMetaTag($this->title, 'title', null, array('id'=>'meta_title'), 'meta_title');
		$this->render('index',
			array(
				'Brand'=>$Brand,
				'Models'=>$Models,
				'Categories'=>$Categories,
				'subCategories'=>$subCategories,
				'searchForm'=>$searchForm,
				'WeightBrand'=>$WeightBrand)

			);
	}

	public function actionDisc()
	{

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js?v=2', CClientScript::POS_END);
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/disc.js?v=2', CClientScript::POS_END);
    	$this->breadcrumbs=array('Запчасти'=>'/detail');
    	$searchForm=new Search;

    	if (isset($_GET['Search']))
    	{
    		$searchForm->attributes=$_GET['Search'];
    	}
    	$searchForm->scenario='disc';
    	$searchForm->validate();
    	$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');

    	$weightParts=Parts::getExistsData(null,null,'brand',2);
    	$weightParts->limit=1;
    	$weightParts=CHtml::listData(CarBrands::model()->findAll($weightParts),'id','name');

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
			print($this->renderPartial('tabParts',array('dataProvider'=>$dataProvider,'weightParts'=>$weightParts),true));
		}
	}
	public function actionParts()
	{
		$cs = Yii::app()->clientScript;
    	$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js?v=2', CClientScript::POS_END);
	    $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.scrollTo.min.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->getAssetsUrl().'/js/parts.js?v=2', CClientScript::POS_END);
		Yii::app()->clientScript->registerMetaTag('123123', 'title', null, array('id'=>'meta_title'), 'meta_title');
		$this->breadcrumbs=array('Запчасти'=>'/detail');
		
		$searchForm=new Search;
		

		if (isset($_GET['Search']))
		{
			$searchForm->attributes=$_GET['Search'];

		}
		$searchForm->scenario= 'parts';
		$searchForm->validate();
		
		
		$countriCriteria=Parts::getExistsData(null,null,'id_country');
		$Countries=CHtml::listData(Country::model()->findAll($countriCriteria),'id','name');

		$Categories=$searchForm->car_model_id ? CHtml::listData(
				Categories::model()->findAll(
					Parts::getExistsData(
						$searchForm->car_model_id,
						'car_model_id',
						'parent',
						$searchForm->type)
					),
				'id','name'
			) : array();
		$Brands=CHtml::listData(
					CarBrands::model()
						->findAll(
							Parts::getExistsData(
								null,
								null,
								'brand',
								$searchForm->type)
						)
					,'id','name');

		$Models=$searchForm->brand ? CHtml::listData(
					CarModels::model()->findAll(
						Parts::getExistsData(
							$searchForm->brand,
							'brand',
							'car_model_id',
							$searchForm->type)
						),
					'id','name'
				) : array();

		$subCatCriteria=array();
		$subCategories=array();
		if ($searchForm->parent && $searchForm->car_model_id)
		{
			$subCatCriteria=Parts::getExistsData(
							$searchForm->car_model_id,
							'car_model_id',
							'category_id',
							$searchForm->type
						);
			$subCatCriteria->addCondition('parent='.$searchForm->parent);

			$subCategories=CHtml::listData(
					Categories::model()->findAll($subCatCriteria),
					'id','name'
				);

		}

		$WeightBrandsExists=Parts::getExistsData(null,null,'brand',2);
		$WeightBrandsExists->limit=1;

		$WeightBrandsExists=CarBrands::model()->findAll($WeightBrandsExists)!=array();
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
				'WeightBrandsExists'=>$WeightBrandsExists,
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
			//var_dump($searchForm->criteria->condition);die();
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

			$response['count']=Yii::t('app', '{n} товар|{n} товара|{n} товаров',$cart->getItemsCount());
				$response['summ']=$cart->getCost();

				if ($response['count'])
					$response['html']=
							'<ul>
	        				    <li>
	        					<a href="/cart">'+$response['count']+' товар</a>
	        				    </li>
	        				    <li>
	        					На сумму: <strong>'+number_format($response['sum'],0,' ',' ')+' руб.</strong>
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
		$cs->registerScriptFile($this->getAssetsUrl().'/js/partsView.js?v=2', CClientScript::POS_END);
		Yii::app()->clientScript->registerMetaTag($this->modelName, 'title', null, array('id'=>'meta_title'), 'meta_title');

		$model=Parts::model()->findByPk($id);
		if (!$model && $model->status!=1)
		{
			throw new CHttpException("По вашему запросу не было найдено данных", 404);
			die();
		}
		$this->model=$model;	
		$brand=$model->car_model->car_brand->id;
		$car_model=$model->car_model->id;
		$category_id=$model->category->id;
		
		if (!$params=Yii::app()->session->get('backToResult'))
		{
			$return=$this->createUrl('/detail/parts',array('Search'=>array(
						'brand'=>$model->car_model->car_brand->id,
						'car_model_id'=>$model->car_model->id,
						'type'=>$model->car_model->car_type,
					)
				)
			);
		}else 
			$return='/detail/parts?'.$params;	
		$search=new Search;
		$search->car_model_id=$car_model;
		$search->category_id=$category_id;
		$search->scenario="parts";
		$search->validate();
		//$criteria=Parts::model()->search_parts('model_cat',array('model_id'=>$car_model,'cat_id'=>$category_id));
		$criteria=$search->criteria;
		//$criteria->addCondition('category_id='.$model->category->id);
		$dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{parts}}');
		
		$dataProvider=new CActiveDataProvider(Parts::model()->cache(3600,$dependecy,2),
			array(
				'criteria'=>$criteria,
				'pagination'=>false,
			)
		);

		$this->title=$model->name;
		 Yii::app()->clientScript->registerMetaTag($this->title, 'title', null, array('id'=>'meta_title'), 'meta_title');
		$this->render('view',
			array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'return'=>$return,
				'state'=>$model->inCart(),
				)
			);
	}


}
