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
		foreach ($parts as $key => $data) {
			if($image=$data->gallery->galleryPhotos[0])
				if (!file_exists($path=$image->getUrl()))
					echo "$data->id.<img src=\"$path\"><br>";
		}
	}

}
