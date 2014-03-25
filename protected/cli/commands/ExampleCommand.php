<?php
/*
 * Сравнение даты проведения события с текущим днем.
 * Если событие прошло, то его тип меняется на хронику.
 */
class ExampleCommand extends CConsoleCommand {
    public function run($args) {
		$part = Parts::model()->findByPk(1);

		$part->name = 'Стартер111';
		$part->update(array('name'));
    }
}
?>
