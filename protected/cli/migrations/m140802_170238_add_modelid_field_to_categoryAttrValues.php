<?php
/**
 * Миграция m140802_170238_add_modelid_field_to_categoryAttrValues
 *
 * @property string $prefix
 */
 
class m140802_170238_add_modelid_field_to_categoryAttrValues extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
    public function up()
    {
        $this->addColumn('{{category_attr_values}}', 'model_id', 'int');
    }

    public function down()
    {
        $this->dropColumn('{{category_attr_values}}', 'model_id');
    }
}
 