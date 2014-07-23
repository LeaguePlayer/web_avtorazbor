<?php
/**
 * Миграция m140719_145152_add_brand_country_field
 *
 * @property string $prefix
 */
 
class m140719_145152_add_brand_country_field extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up()
    {
        $this->addColumn('{{carBrands}}', 'id_country', 'int COMMENT "Страна"');
    }

    public function down()
    {
        $this->dropColumn('{{carBrands}}', 'id_country');
    }
}