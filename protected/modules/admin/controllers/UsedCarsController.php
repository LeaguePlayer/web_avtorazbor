<?php

class UsedCarsController extends AdminController
{
	public function actionCreate(){
		$model = new UsedCars;
		$dop = new UsedCarInfo;
		$owner = new Owners;

		if(isset($_POST['UsedCars'])){
			$model->attributes = $_POST['UsedCars'];

			$valid = $model->validate();

			if(isset($_POST['Owners'])){
				$owner->attributes = $_POST['Owners'];
				$valid = $valid && $owner->validate();
			}

			if(isset($_POST['UsedCarInfo'])){
				$dop->attributes = $_POST['UsedCarInfo'];
				$valid = $valid && $dop->validate();
			}			

			if($valid && $model->save(false)){
				$owner->used_car_id = $model->id;
				$dop->used_car_id = $model->id;

				$owner->save(false);
				$dop->save(false);

				$this->redirect($this->createUrl('list'));
			}
		}

		$this->render('create', array(
			'model' => $model,
			'dop' => $dop,
			'owner' => $owner
		));	
	}

	public function actionUpdate($id){
		$model = UsedCars::model()->findByPk($id);
		$dop = $model->dop ? $model->dop : new UsedCarInfo;
		$owner = $model->owner ? $model->owner : new Owners;

		if(isset($_POST['UsedCars'])){
			$model->attributes = $_POST['UsedCars'];

			$valid = $model->validate();

			if(isset($_POST['Owners'])){
				$owner->attributes = $_POST['Owners'];
				$valid = $valid && $owner->validate();
			}

			if(isset($_POST['UsedCarInfo'])){
				$dop->attributes = $_POST['UsedCarInfo'];
				$valid = $valid && $dop->validate();
			}			

			if($valid && $model->save(false)){
				$owner->used_car_id = $model->id;
				$dop->used_car_id = $model->id;

				$owner->save(false);
				$dop->save(false);

				$this->redirect($this->createUrl('list'));
			}
		}

		$this->render('update', array(
			'model' => $model,
			'dop' => $dop,
			'owner' => $owner
		));
	}
}
