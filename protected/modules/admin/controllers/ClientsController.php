<?php

class ClientsController extends AdminController
{
	public function actionCreate(){
		$model = new Clients;
		$info = new ClientsInfo;
		$accounts = array();

		$accounts[] = new BankAccounts;

		if(isset($_POST['Clients'])){
			$model->attributes = $_POST['Clients'];

			$valid = $model->validate();

			if($model->type == 2 && isset($_POST['ClientsInfo'])){ //Юр лицо
				$info->attributes = $_POST['ClientsInfo'];

				$valid = $valid && $info->validate();

				//check BankAccounts
				if(isset($_POST['BankAccounts'])){
					$accounts = array();

					foreach ($_POST['BankAccounts'] as $acc) {
						$acc_model = new BankAccounts;
						$acc_model->attributes = $acc;

						$valid = $valid && $acc_model->validate();
						$accounts[] = $acc_model;
					}
				}

				if($valid){
					$model->save(false);

					$info->client_id = $model->id;
					$info->save(false);

					foreach ($accounts as $acc) {
						$acc->client_id = $model->id;
						$acc->save(false);
					}
				}
			}else
				$model->save(false);

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('create', array(
			'model' => $model,
			'info' => $info,
			'accounts' => $accounts
		));
	}

	public function actionUpdate($id){
		$model = Clients::model()->findByPk($id);
		$info = $model->info ? $model->info : new ClientsInfo;
		$accounts = array();

		if(!$model->bank_accounts)
			$accounts[] = new BankAccounts;
		else 
			$accounts = $model->bank_accounts;

		if(isset($_POST['Clients'])){
			$model->attributes = $_POST['Clients'];

			$valid = $model->validate();

			if($model->type == 2 && isset($_POST['ClientsInfo'])){ //Юр лицо
				$info->attributes = $_POST['ClientsInfo'];

				$valid = $valid && $info->validate();

				//check BankAccounts
				if(isset($_POST['BankAccounts'])){
					$accounts = array();

					foreach ($_POST['BankAccounts'] as $acc) {
						$acc_model = isset($acc['id']) ? BankAccounts::model()->findByPk($acc['id']) : new BankAccounts;
						$acc_model->attributes = $acc;

						$valid = $valid && $acc_model->validate();
						$accounts[] = $acc_model;
					}
				}

				if($valid){
					$model->save(false);

					$info->client_id = $model->id;
					$info->save(false);

					foreach ($accounts as $acc) {
						$acc->client_id = $model->id;
						$acc->save(false);
					}
				}
			}else
				$model->save(false);

			if($valid)
				$this->redirect($this->createUrl('list'));
		}

		$this->render('update', array(
			'model' => $model,
			'info' => $info,
			'accounts' => $accounts
		));
	}

	public function actionAddRow($index){

		$model = new BankAccounts;

		$this->renderPartial('/bankAccounts/_row', array('model' => $model, 'id' => $index));
		Yii::app()->end();
	}

	public function actionGetClientForm($id=null, $name=null){
		
		$model = new Clients;
		$info = new ClientsInfo;
		$accounts = array();

		$accounts[] = new BankAccounts;

		if($id){
			$model = Clients::model()->findByPk($id);
			$info = $model->info ? $model->info : new ClientsInfo;
			$accounts = array();

			if(!$model->bank_accounts)
				$accounts[] = new BankAccounts;
			else 
				$accounts = $model->bank_accounts;
		}

		$model->type = 2;

		if($name)
			$info->name_company = $name;

		$this->renderPartial('_modelWindow', array('model'=>$model, 'info' => $info, 'accounts' => $accounts));

		Yii::app()->end();
	}
}
