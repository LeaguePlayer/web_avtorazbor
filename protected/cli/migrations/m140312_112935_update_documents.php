<?php
/**
 * Миграция m140312_112935_update_documents
 *
 * @property string $prefix
 */
 
class m140312_112935_update_documents extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{Documents}}', 'name', 'string COMMENT "Название документа"');
        $this->addColumn('{{Documents}}', 'used_car_id', 'int COMMENT "Бу автомобиль"');
        $this->addColumn('{{Documents}}', 'template_id', 'int COMMENT "Шаблон"');
        $this->addColumn('{{Documents}}', 'sum', 'decimal(10,2) COMMENT "Сумма"');
        $this->addColumn('{{Documents}}', 'create_time', 'datetime COMMENT "Дата создания"');
        $this->addColumn('{{Documents}}', 'update_time', 'datetime COMMENT "Дата последнего редактирования"');

        // 'create_time' => "datetime COMMENT 'Дата создания'",
        //     'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
    }

    public function down()
    {
        $this->dropColumn('{{Documents}}', 'name');
        $this->dropColumn('{{Documents}}', 'used_car_id');
        $this->dropColumn('{{Documents}}', 'create_time');
        $this->dropColumn('{{Documents}}', 'update_time');
        $this->dropColumn('{{Documents}}', 'template_id');
        $this->dropColumn('{{Documents}}', 'sum');
    }
}