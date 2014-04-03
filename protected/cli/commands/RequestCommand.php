<?php
/*
 * Сравнение даты проведения события с текущим днем.
 * Если событие прошло, то его тип меняется на хронику.
 */
class RequestCommand extends CConsoleCommand {

	public function actionBroken($id){
		$request = Requests::model()->findByPk($id);

		$request->status = Requests::STATUS_BROKEN;
		$request->update(array('status'));

		//delete task from cron
        // $request->deleteTaskFromCron();
	}
  //   public function run($args) {
		// $part = Parts::model()->findByPk(1);

		// $part->name = 'Стартер111';
		// $part->update(array('name'));
  //   }
}