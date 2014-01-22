<?php

class PartsController extends AdminController
{
	public function actionCreate(){
		$model = new Parts;

		if(isset($_POST['Parts'])){
			$model->attributes = $_POST['Parts'];

			if($model->save()){
				
				if(!$this->saveAnalogs($model))
					$this->redirect($this->createUrl('update', array('id' => $model->id)));

				$this->redirect($this->createUrl('list'));
			}	
		}

		$this->render('create', array(
			'model' => $model
		));
	}

	public function actionUpdate($id){
		$model = Parts::model()->findByPk($id);

		$model->price_sell = number_format($model->price_sell, 0, '', '');
		$model->price_buy = number_format($model->price_buy, 0, '', '');

		if(isset($_POST['Parts'])){

			$model->attributes = $_POST['Parts'];

			if($model->save()){
				
				if(!$this->saveAnalogs($model))
					$this->redirect($this->createUrl('update', array('id' => $model->id)));

				$this->redirect($this->createUrl('list'));
			}	
		}

		$this->render('update', array(
			'model' => $model
		));
	}


	/*public function actionDelete($id){
		$model = Parts::model()->findByPk($id);


	}*/

	private function saveAnalogs($model){
		
		if(isset($_POST['Analogs_delete']) && !$model->isNewRecord){
			foreach ($_POST['Analogs_delete'] as $id) {
				$a = Analogs::model()->find('part=:part AND analog=:analog', array(':part' => $model->id, ':analog' => $id));

				if($a) $a->delete();
			}
		}

		if(isset($_POST['Analogs'])){

			foreach ($_POST['Analogs'] as $val) {
				$analog = new Analogs;

				$analog->part = $model->id;
				$analog->analog = $val;

				if(!$analog->save()) return false;
			}
		}

		return true;
	}
}
