<?php

use console\classes\parsers\ParserXlsx;
use yii\db\Migration;

/**
 * Class m200425_180356_fill_raw_routing_steps_table
 */
class m200425_180356_fill_raw_routing_steps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 37; $i <= 39; $i++) {
            $file_path = Yii::getAlias('@console') . '/resources/default_tables/06.RoutringSteps_'.$i.'.xlsx';
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
        echo "m200425_180356_fill_raw_routing_steps_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200425_180356_fill_raw_routing_steps_table cannot be reverted.\n";

        return false;
    }
    */
}
