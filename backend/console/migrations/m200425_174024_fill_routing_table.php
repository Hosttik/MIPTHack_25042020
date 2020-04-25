<?php

use console\classes\parsers\ParserXlsx;
use yii\db\Migration;

/**
 * Class m200425_174024_fill_routing_table
 */
class m200425_174024_fill_routing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i <= 32; $i++) {
            $file_path = Yii::getAlias('@console') . '/resources/default_tables/05.Routrings_'.$i.'.xlsx';
            $parser = (new ParserXlsx($file_path));
            $parser->parse();
            unset($parser);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200425_174024_fill_routing_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200425_174024_fill_routing_table cannot be reverted.\n";

        return false;
    }
    */
}
