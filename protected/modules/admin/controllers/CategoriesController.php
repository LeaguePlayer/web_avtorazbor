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

	public function saveAttrs($id)
	{
		if (isset($_POST['attr']))
		{

			foreach ($_POST['attr'] as $key => $value) {

				if (!empty($value))
				{
					$model=new CategoryAttr;
					$model->category_id=$id;
					$model->attr=$value;
					$model->type=$_POST['required'][$key] == 'on';
					
					var_dump($model->validate());
					die();
				}
			}
		}
	}

	public function actionCreate(){

		$model=new Categories;

		if (isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];

			if ($model->validate())
			{
				$model->save();
				$this->saveAttrs($model->id);
				$this->redirect(array('list'));
			}
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id){

		$model=Categories::model()->findByPk($id);

		if (isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];

			if ($model->validate())
			{

				$model->save();
				$model->deleteAttrs();

				$this->saveAttrs($model->id);

				$this->redirect(array('list'));
			}
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionList(){

		$filter = false;
		$model = new Categories;
		$show_array = isset(Yii::app()->request->cookies['show']) ? unserialize(Yii::app()->request->cookies['show']->value) : array();

		//show GET
		if(isset($_GET['show']) && $_GET['show'] > 0){
			if(!in_array($_GET['show'], $show_array)) $show_array[] = $_GET['show'];
			
			Yii::app()->request->cookies['show'] = new CHttpCookie('show', serialize($show_array));
		}

		//hide GET
		if(isset($_GET['hide']) && $_GET['hide'] > 0){
			if(in_array($_GET['hide'], $show_array)){
				$i = array_search($_GET['hide'], $show_array);

				if($i >= 0 && isset($show_array[$i])) unset($show_array[$i]);
			}
			
			Yii::app()->request->cookies['show'] = new CHttpCookie('show', serialize($show_array));
		}

		$data = null;

		if(isset($_GET['Categories']) && !empty($_GET['Categories']['name'])){
			$filter = true;
			$model->attributes = $_GET['Categories'];
		}

		if($filter){
			//grid filter
			$data = $model->search();
		}else{
			$result = array();
	    	$roots = Categories::model()->findAll('parent=0');

			foreach ($roots as $root) {
				$result[] = $root;

				if(!empty($root->children) && $root->inCookies()) $result = array_merge($result, $root->children);
			}

			$data = new CArrayDataProvider($result, array(
	        	'pagination' => false
	        ));
		}


        if(Yii::app()->request->isAjaxRequest)
        	$this->renderPartial('list', array(
	            'data' => $data,
	            'model' => $model,
	            'show_array' => $show_array,
	            // 'showRemoved' => $showRemoved,
	        ));
        else
	        $this->render('list', array(
	            'data' => $data,
	            'model' => $model,
	            'show_array' => $show_array,
	            // 'showRemoved' => $showRemoved,
	        ));
	}

	public function actionAllJson($q, $emptyField = true){
		header('Content-type: application/json');

		if(!is_bool($emptyField))
			$emptyField = ($emptyField === 'true');

		$result = array();
		if(!$q){
			$roots = Yii::app()->db->createCommand()
				->select('id, name as text, parent')
				->from('{{categories}}')
				->where('parent=0')
				->queryAll();

			foreach ($roots as $root) {
				$result[] = $root;

				$children = Yii::app()->db->createCommand()
					->select('id, name as text, parent')
					->from('{{categories}}')
					->where('parent=:root', array(':root' => $root['id']))
					->order('name')
					->queryAll();

				if(!empty($children)) $result = array_merge($result, $children);
			}
		}else{
			$result = Yii::app()->db->createCommand()
				->select('id, name as text, parent')
				->from('{{categories}}')
				->where(array('like', 'name', '%'.$q.'%'))
				->order('name')
				->queryAll();
		}

		foreach ($result as $key => $d) {
            if($d['parent'] != 0) $result[$key]['text'] = "-- ".$d['text'];
        }

        if($emptyField)
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