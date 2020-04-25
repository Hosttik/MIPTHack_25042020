<?php

use console\classes\parsers\ParserXlsx;
use yii\db\Migration;

/**
 * Class m200425_183941_fill_warhouse_table
 */
class m200425_183941_fill_warhouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $file_path = Yii::getAlias('@console') . '/resources/default_tables/warhouse.xlsx';
        (new ParserXlsx($file_path))->parse();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200425_183941_fill_warhouse_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200425_183941_fill_warhouse_table cannot be reverted.\n";

        return false;
    }
    */
}
