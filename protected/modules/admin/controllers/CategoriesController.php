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
}