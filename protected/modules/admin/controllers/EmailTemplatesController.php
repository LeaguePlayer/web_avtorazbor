<?php

class EmailTemplatesController extends AdminController
{
	public function actionGetAttributes($model){

		$modelMap=array(
			'questions'=>'Question',
			'ownprice'=>'Ownprice',
			'bookpart'=>'Bookpart',
			'evackuator'=>'Evackuator',
			'buyout'=>'Buyout',
			'vacansycallback'=>'VacansyCallBack',
		);

		$labels=$modelMap[$model]::model()->attributeLabels();

		echo "<p class=\"caption\">Вы можете использовать следующие марки</p><ul>";
		foreach ($labels as $key => $label) {
			echo "<li>{{$key}} - $label</li>";
		}
		echo "</ul>";
		yii::app()->end();
	}
}
