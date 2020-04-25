<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%raw_resource_group_period}}`.
 */
class m200425_172736_create_raw_resource_group_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%raw_resource_group_period}}', [
            'id' => $this->primaryKey(),
            'ResourceGroupID' => $this->string(),
            'IdPeriod' => $this->string(),
            'AvailableCapacity' => $this->string(),
            'FreeCapacity' => $this->string(),
            'Start' => $this->string(),
            'HasFiniteCapacity' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raw_resource_group_period}}');
    }
}
