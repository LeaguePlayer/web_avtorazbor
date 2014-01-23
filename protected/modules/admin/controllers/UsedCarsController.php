<?php

class UsedCarsController extends AdminController
{
	public function actionCreate(){
		$model = new UsedCars;
		$dop = new UsedCarInfo;

		if(isset($_POST['UsedCars'])){
			$model->attributes = $_POST['UsedCars'];

			$valid = $model->validate();

			if($model->status == 2 && isset($_POST['UsedCarInfo'])){ //Юр лицо
				$dop->attributes = $_POST['UsedCarInfo'];

				$valid = $valid && $dop->validate();

				if($valid){
					$model->save(false);

					$dop->used_car_id = $model->id;
					$dop->save(false);
				}
			}else
				$model->save(false);

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array(
			'model' => $model,
			'dop' => $dop
		));
	}

	public function actionUpdate($id){
		$model = UsedCars::model()->findByPk($id);
		$dop = $model->dop ? $model->dop : new UsedCarInfo;

		if(isset($_POST['UsedCars'])){
			$model->attributes = $_POST['UsedCars'];

			$valid = $model->validate();

			if($model->status == 2 && isset($_POST['UsedCarInfo'])){ //Юр лицо
				$dop->attributes = $_POST['UsedCarInfo'];

				$valid = $valid && $dop->validate();

				if($valid){
					$model->save(false);

					$dop->used_car_id = $model->id;
					$dop->save(false);
				}
			}else{
				if(!$dop->isNewRecord) $dop->delete();
				$model->save(false);
			}

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('update', array(
			'model' => $model,
			'dop' => $dop
		));
	}
}
