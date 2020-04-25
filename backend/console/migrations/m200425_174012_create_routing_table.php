<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%routing}}`.
 */
class m200425_174012_create_routing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%raw_routing}}', [
            'id' => $this->primaryKey(),
            'RoutingId' => $this->string(),
            'InputProductId' => $this->string(),
            'OutputProductId' => $this->string(),
            'InputStockingPointId' => $this->string(),
            'OutputStockingPointId' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raw_routing}}');
    }
}
