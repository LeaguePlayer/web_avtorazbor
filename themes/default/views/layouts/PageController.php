<?php

class PageController extends AdminController
{
	public function actionSetAliases($array=array())
	{
		if (!$array)
			$array=array('Parts','UsedCars');

		foreach ($array as $key => $table) {
			$result=Yii::app()->db->createCommand()
				->select('id,name')
				->from("tbl_$table")
				->queryAll();
			foreach($result as $data)
			{
				echo "<br>".Yii::app()->db->createCommand()
					->update("tbl_$table",array('alias'=>SiteHelper::translit($data['name'])),"id=".$data['id']);
			}
		}
		echo "ок";
	}

	public function actionCheckParts()
	{
		$parts=Parts::model()->findAll();
		$id=0;

		$offset = 0;
		$limit = 100;

		

		while () {}

		foreach ($parts as $key => $data) {
			$id=$key;
			$glr=$data->existsGalleryPhotos();
			var_dump($glr);
			if (!$glr)
				echo "$data->id<br>";
		}
		echo $id;
	}
}
