<?php

class CarModelsController extends AdminController
{
	public function actionAnalogModels($id, $q){
		header('Content-type: application/json');

		$data = Yii::app()->db->createCommand()
			->select('m.id, CONCAT(b.name, " ", m.name) as text')
			->from('{{CarModels}} m')
			->join('{{CarBrands}} b', 'm.brand = b.id')
			->where('m.id != :id AND CONCAT(b.name, " ", m.name) LIKE "%'.$q.'%"', array(':id' => $id))
			->queryAll();

		if($data){
			echo CJSON::encode($data);
		}

		Yii::app()->end();
	}

	public function actionAllJson($q){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('m.id, CONCAT(b.name, " ", m.name) as text')
			->from('{{CarModels}} m')
			->join('{{CarBrands}} b', 'm.brand = b.id')
			->where('CONCAT(b.name, " ", m.name) LIKE "%'.$q.'%"')
			->queryAll();

		array_unshift($result, array('id' => 0, 'text' => 'Нет'));

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionGetOneById($id){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('m.id, CONCAT(b.name, " ", m.name) as text')
			->from('{{CarModels}} m')
			->join('{{CarBrands}} b', 'm.brand = b.id')
			->where('m.id=:id', array(':id' => $id))
			->queryRow();

		if($result) echo CJSON::encode($result);
		else echo CJSON::encode(array('id' => 0, 'text' => 'Нет'));

		Yii::app()->end();
	}


	/**
	 * Parse all car models and 
	 * brands from http://euroauto.ru
	 */
	public function actionParse(){
		require_once(Yii::getPathOfAlias('ext').DIRECTORY_SEPARATOR.'simple_html_dom.php');
		//Yii::import('ext.simple_html_dom');

		$html = file_get_html('http://euroauto.ru/?type=1'); //brands

		foreach($html->find('#content_middle_inner .firms-list') as $list){

			foreach ($list->find('a') as $a) {

				$brand_name = $a->plaintext;

				$brand = CarBrands::model()->find('name=:name', array(':name' => $brand_name));
				if(!$brand) {
					$brand = new CarBrands;

					$brand->name = $brand_name;
					$brand->save();
				}

				$html_models = file_get_html('http://euroauto.ru/'.$a->href); //brands

				foreach($html_models->find('#content_middle_inner .firms-list a') as $am){
					$car_model_name = $am->plaintext;

					if($brand){
						$car_model = CarModels::model()->find('name=:name AND brand=:brand', array(
							':name' => $brand_name,
							':brand' => $brand->id,
						));
						if(!$car_model) {
							$car_model = new CarModels;

							$car_model->name = $car_model_name;
							$car_model->brand = $brand->id;
							$car_model->save();
						}
					}
				}

			}

			//parse only one list
			break;
		}

		$this->redirect($this->createUrl('list'));
	}
}
