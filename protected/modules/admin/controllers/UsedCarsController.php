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

	public function actionUpdate($id){
		$model = UsedCars::model()->findByPk($id);
		$dop = $model->dop ? $model->dop : new UsedCarInfo;
		$owner = $model->owner ? $model->owner : new Clients;

		$this->saveModels($model, $dop, $owner);

		$this->render('update', array(
			'model' => $model,
			'dop' => $dop,
			'owner' => $owner
		));
	}

	private function saveModels(&$model, &$dop, &$owner){

		if(isset($_POST['UsedCars'])){
			$model->attributes = $_POST['UsedCars'];

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
