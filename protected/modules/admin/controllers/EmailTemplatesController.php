<?php

class EmailTemplatesController extends AdminController
{
	public function actionGetAttributes($model){
		$labels=$model::model()->attributeLabels();
		echo "<p class=\"caption\">Вы можете использовать следующие марки</p><ul>";
		foreach ($labels as $key => $label) {
			echo "<li>{{$key}} - $label</li>";
		}
		echo "</ul>";
		yii::app()->end();
	}
}
