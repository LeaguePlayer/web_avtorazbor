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
        $this->addColumn('{{CarBrands}}', 'id_country', 'int COMMENT "Страна"');
    }

    public function down()
    {
        $this->dropColumn('{{CarBrands}}', 'id_country');
    }
}