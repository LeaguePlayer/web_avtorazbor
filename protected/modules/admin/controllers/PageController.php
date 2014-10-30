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
		$id=0;
		
		$count=Yii::app()->db->createCommand()
			->select('count(id) as count')
			->from('tbl_Parts')
			->queryRow();
		$count=(int)$count['count'];

		$offset = $count-3000;
		$limit = 100;

		while ($offset<$count){
			
			$criteria=new CDbCriteria;
			$criteria->addCondition("id>$offset");
			$criteria->limit=$limit;

			$models=Parts::model()->findAll($criteria);
			foreach ($models as $key => $data) {
				$id=$data->id;
				if (!$data->existsGalleryPhotos())
					echo $data->id."<br>";

			}
			$offset+=$limit;
			unset($models);
			unset($criteria);
		}
	}
}
