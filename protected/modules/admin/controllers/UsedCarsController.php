<?php

class UsedCarsController extends AdminController
{
	public $layout = '/layouts/custom';

	public function actionCreate(){



		$model = new UsedCars;
		$dop = new UsedCarInfo;
		$owner = new Clients;
		
		$this->saveModels($model, $dop, $owner);

		$this->render('create', array(
			'model' => $model,
			'dop' => $dop,
			'owner' => $owner
		));	
	}

	public function actionChangeAlias($id=0){
			
		set_time_limit(30);
		$max=Yii::app()->db->createCommand()->select('max(id) as id')->from('{{Parts}}')->queryRow();
		$count=$id;
		while($count<$max['id'])
		{
			$criteria=new CDbCriteria;
			$criteria->addCondition('id>:count');
			$criteria->params[':count']=$count;
			$criteria->limit=200;
			$models=UsedCars::model()->findAll($criteria);

			foreach ($models as $key => $value) {
				
				$value->alias=mb_strtolower(SiteHelper::translit($value->model->car_brand->name.'_'.$value->model->name.'_'.$value->id));
				Yii::app()->db->createCommand()->update('{{UsedCars}}',array('alias'=>$value->alias),'id='.$value->id);

				echo $value->id.'<br>';
			}
			unset($models);
			$count+=200;
		}
		echo "the fin";
	}

	public function actionUpdate($id){

		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->getAssetsUrl().'/js/usedcars.js', CClientScript::POS_END);

		$model = UsedCars::model()->findByPk($id);
		$dop = $model->dop ? $model->dop : new UsedCarInfo;
		$owner = $model->owner ? $model->owner : new Clients;

		$this->saveModels($model, $dop, $owner);

		$displayBascet=($model->model->car_type==1 ? 'display:none' : 'display:block');

		$this->render('update', array(
			'model' => $model,
			'dop' => $dop,
			'owner' => $owner,
			'displayBascet'=>$displayBascet
		));
	}

	public function actionAjaxDisplayBascet($id){

		$car_type=CarModels::model()->find('id=:id',array(':id'=>$id))->car_type;
		
		$responce=array();

		$responce['success']=$car_type==1;

		echo CJSON::encode($responce);

	}	

	private function saveModels(&$model, &$dop, &$owner){

		

		if(isset($_POST['UsedCars'])){

			$model->attributes = $_POST['UsedCars'];
			$model->more_info=$_POST['UsedCars']['more_info'];
			$model->year=$_POST['UsedCars']['year'];
			
			$model->force = $model->force ? $model->force : 0;
			$model->price = $model->price ? $model->price : 0;
			
			$valid = $model->validate();

			if($model->status == 2 && isset($_POST['Clients'])){
				$owner->attributes = $_POST['Clients'];
				$valid = $owner->validate() && $valid;
			}

			if(isset($_POST['UsedCarInfo'])){
				$dop->attributes = $_POST['UsedCarInfo'];
				$valid = $valid && $dop->validate();
			}

			$new = $model->isNewRecord;
			
			if($valid && $model->save(false)){
				$owner->used_car_id = $model->id;
				$dop->used_car_id = $model->id;

				if($model->status == 2) $owner->save(false);

				$dop->save(false);

				if($model->status == 2 && $new){
					Yii::app()->user->setFlash('success', "Добавлен автомобиль для продажи.");
					DocumentBuilder::createDogovorKomissii($model);
					$this->redirect($this->createUrl('update', array('id' => $model->id)));
				}

				$this->redirect($this->createUrl('list'));
			}
		}
	}
}
