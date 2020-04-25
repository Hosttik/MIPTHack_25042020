<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%raw_routing_steps}}`.
 */
class m200425_180345_create_raw_routing_steps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%raw_routing_steps}}', [
            'id' => $this->primaryKey(),
            'RoutingStepId' => $this->string(),
            'SequenceNr' => $this->integer(),
            'RoutingId' => $this->string(),
            'ResourceGroupId' => $this->string(),
            'Yield' => $this->float(),
            'IdPlant' => $this->integer(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raw_routing_steps}}');
    }
}
