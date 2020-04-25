<?php

use yii\db\Migration;

/**
 * Class m200425_151425_create_raw_supply_orders_table
 */
class m200425_151425_create_raw_supply_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('raw_supply_orders', [
            'id' => $this->primaryKey(),
            'PlanId' => $this->string(),
            'ProductId' => $this->string(),
            'Order/Positions' => $this->string(),
            'ProductName' => $this->string(),
            'Vid_Product' => $this->string(),
            'Count' => $this->float(),
            'IDSklad' => $this->string(),
            'Planned Status' => $this->string(),
            'Begin' => $this->string(),
            'End' => $this->string(),
            'Deadline' => $this->string(),
            'ProductIdFull' => $this->string(),
            'RoutingId' => $this->string(),
            'DownstreamCustomerOrders' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable('raw_supply_orders');
    }
}
