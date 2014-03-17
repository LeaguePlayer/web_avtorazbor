<?php

class CategoriesController extends AdminController
{

	public function actionParse(){

		if(isset($_POST['url']) && !empty($_POST['url'])){
			
			require_once(Yii::getPathOfAlias('ext').DIRECTORY_SEPARATOR.'simple_html_dom.php');
			//Yii::import('ext.simple_html_dom');

			$html = file_get_html($_POST['url']); //parts

			foreach($html->find('#parts .group') as $k => $cat){

				// echo $cat->plaintext.'<br>';

				//roots categories
				$root = Categories::model()->find('name=:n AND parent=:p', array(':n' => $cat->plaintext, ':p' => 0));
				
				if(!$root){
					$root = new Categories;
					
					$root->name = $cat->plaintext;
					$root->parent = 0;
					$root->sort = $k + 1;
					$root->level = 1;

					$root->save();
				}

				$a = $cat->parent();

				$sub = file_get_html('http://euroauto.ru'.$a->href);

				//sub categories
				foreach ($sub->find('.ulplusminus a') as $j => $sub_cat) {
					// echo '- '.$sub_cat->plaintext.'<br>';

					$sub_root = Categories::model()->find('name=:n AND parent=:p', array(':n' => $sub_cat->plaintext, ':p' => $root->id));

					//if not find then save sub category
					if(!$sub_root){
						$sub_root = new Categories;
						
						$sub_root->name = $sub_cat->plaintext;
						$sub_root->parent = $root->id;
						$sub_root->sort = $j + 1;
						$sub_root->level = 2;

						$sub_root->save();
					}
				}
			}

			$this->redirect($this->createUrl('list'));
		}
		
		$this->render('parser');
	}

	public function actionList(){
		$model = new Categories;

		// TODO	Переписать !!!
		$show_array = isset(Yii::app()->request->cookies['show']) ? unserialize(Yii::app()->request->cookies['show']->value) : array();

		if(isset($_GET['show']) && $_GET['show'] > 0){
			if(!in_array($_GET['show'], $show_array)) $show_array[] = $_GET['show'];
			
			Yii::app()->request->cookies['show'] = new CHttpCookie('show', serialize($show_array));
		}
        
        if(isset($_GET['Categories']))
            $model->attributes = $_GET['Categories'];
        
        $data = $model->search();
        $result = array();
        foreach ($data->data as $d) {
        	$result[] = $d;
        	if(in_array($d->id, $show_array))
        		$result += $d->children;
        };

        $data = new CArrayDataProvider($result, array(
        	'pagination' => false
        ));

        if(Yii::app()->request->isAjaxRequest)
        	$this->renderPartial('list', array(
	            'data' => $data,
	            'model' => $model,
	            // 'showRemoved' => $showRemoved,
	        ));
        else
	        $this->render('list', array(
	            'data' => $data,
	            'model' => $model,
	            // 'showRemoved' => $showRemoved,
	        ));
	}

	public function actionAllJson($q){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text, parent')
			->from('{{categories}}')
			->where(array('like', 'name', '%'.$q.'%'))
			->queryAll();

		foreach ($result as $key => $d) {
            if($d['parent'] != 0) $result[$key]['text'] = "-- ".$d['text'];
        }

		array_unshift($result, array('id' => 0, 'text' => 'Нет'));

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionGetOneById($id){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{categories}}')
			->where('id=:id', array(':id' => $id))
			->queryRow();

		if($result) echo CJSON::encode($result);
		else echo CJSON::encode(array('id' => 0, 'text' => 'Нет'));

		Yii::app()->end();
	}
}