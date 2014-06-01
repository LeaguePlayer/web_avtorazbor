<?php
/**
 * Миграция m140601_105836_update_users
 *
 * @property string $prefix
 */
 
class m140601_105836_update_users extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{users}}', 'allow_app', 'tinyint COMMENT "Доступ к приложению"');
    }

    public function down()
    {
        $this->dropColumn('{{users}}', 'allow_app');
    }
}