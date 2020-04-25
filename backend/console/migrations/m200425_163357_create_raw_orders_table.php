<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%raw_orders}}`.
 */
class m200425_163357_create_raw_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%raw_operations}}', [
            'id' => $this->primaryKey(),
            'IdOperation' => $this->string(),
            'OperationDescription' => $this->string(),
            'SequenceNr' => $this->integer(),
            'AvailabledResN' => $this->string(),
            'Start' => $this->string(),
            'End' => $this->string(),
            'ProductionTime' => $this->string(),
            'InputQuantity' => $this->float(),
            'Output quantity' => $this->float(),
            'SchedulingSpace' => $this->string(),
            'ResourceGroupId' => $this->string(),
            'OperationCode' => $this->integer(),
            'RoutingStepId' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raw_operations}}');
    }
}
