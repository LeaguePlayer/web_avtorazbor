<?php

class ClientsController extends AdminController
{
	public function actionCreate(){
		$model = new Clients;
		$info = new ClientsInfo;

		if(isset($_POST['Clients'])){
			$model->attributes = $_POST['Clients'];

			$valid = $model->validate();

			if($model->type == 2 && isset($_POST['ClientsInfo'])){ //Юр лицо
				$info->attributes = $_POST['ClientsInfo'];

				$valid = $valid && $info->validate();

				if($valid){
					$model->save(false);

					$info->client_id = $model->id;
					$info->save(false);
				}
			}else
				$model->save(false);

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array(
			'model' => $model,
			'info' => $info
		));
	}

	public function actionUpdate($id){
		$model = Clients::model()->findByPk($id);
		$info = $model->info ? $model->info : new ClientsInfo;

		if(isset($_POST['Clients'])){
			$model->attributes = $_POST['Clients'];

			$valid = $model->validate();

			if($model->type == 2 && isset($_POST['ClientsInfo'])){ //Юр лицо
				$info->attributes = $_POST['ClientsInfo'];

				$valid = $valid && $info->validate();

				if($valid){
					$model->save(false);

					$info->client_id = $model->id;
					$info->save(false);
				}
			}else
				$model->save(false);

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('update', array(
			'model' => $model,
			'info' => $info
		));
	}
}
