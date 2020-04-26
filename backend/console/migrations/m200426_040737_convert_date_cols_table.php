<?php

use console\classes\helpers\DatesHelper;
use console\models\RawCols;
use yii\db\Migration;

/**
 * Class m200426_040737_convert_date_cols_table
 */
class m200426_040737_convert_date_cols_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $cols = RawCols::find()
            ->all();

        /** @var RawCols $col */
        foreach ($cols as $col) {
            $col->LatestDesiredDeliveryDate = DatesHelper::dateToTimestamp($col->LatestDesiredDeliveryDate);
            $col->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200426_040737_convert_date_cols_table cannot be reverted.\n";

        return false;
    }
}
