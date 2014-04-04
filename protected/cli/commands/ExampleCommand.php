<?php
/*
 * Сравнение даты проведения события с текущим днем.
 * Если событие прошло, то его тип меняется на хронику.
 */
class ExampleCommand extends CConsoleCommand {
    public function run($args) {
		var_dump(Yii::app() instanceof CConsoleApplication);
    }
}
?>
