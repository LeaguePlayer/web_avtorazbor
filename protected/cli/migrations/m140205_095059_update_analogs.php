<?php
/**
 * Миграция m140205_095059_update_analogs
 *
 * @property string $prefix
 */
 
class m140205_095059_update_analogs extends CDbMigration
{
    private $_tableName = '{{Analogs}}';

    public function up()
    {
        $this->dropTable($this->_tableName);

        $this->createTable($this->_tableName, array(
            'id' => 'pk', // auto increment
            'model_1' => 'int NOT NULL COMMENT "Модель 1"',
            'cat_id' => 'int NOT NULL COMMENT "Категория"',
            'model_2' => 'int NOT NULL COMMENT "Модель 2"',
            // 'PRIMARY KEY (model_1, cat_id, model_2)'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);

        $this->createTable($this->_tableName, array(
            //'id' => 'pk', // auto increment
            'part' => "int COMMENT 'Запчасть'",
            'analog' => "int COMMENT 'Аналог'",
            'PRIMARY KEY (part, analog)'
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
}