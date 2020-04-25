<?php

use console\classes\parsers\ParserXlsx;
use yii\db\Migration;

/**
 * Class m200425_163407_fill_raw_orders_table
 */
class m200425_163407_fill_raw_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 4; $i <= 4; $i++) {
            $file_path = Yii::getAlias('@console') . '/resources/default_tables/03.Operations_'.$i.'.xlsx';
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
        echo "m200425_163407_fill_raw_orders_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200425_163407_fill_raw_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
