<?php
/**
 * Миграция m141112_060729_add_model_id_to_bouyout
 *
 * @property string $prefix
 */
 
class m141112_060729_add_model_id_to_bouyout extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	public function up(){
        $this->addColumn('{{buyout}}','car_model_id','int');
    }
    public function down(){
        $this->dropColumn('{{buyout}}','car_model_id');   
    }
}