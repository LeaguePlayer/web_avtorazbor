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
}
