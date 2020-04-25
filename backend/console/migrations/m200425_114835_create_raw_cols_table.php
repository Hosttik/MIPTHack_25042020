<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%raw_cols}}`.
 */
class m200425_114835_create_raw_cols_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%raw_cols}}', [
            'id' => $this->primaryKey(),
            'COLAlloc' => $this->string(),
            'Quantity' => $this->float(),
            'MinQuantity' => $this->float(),
            'MaxQuantity' => $this->float(),
            'HasSalesBudgetReservation' => $this->string(),
            'RequiresOrderCombination' => $this->string(),
            'NrOfActiveRoutingChainUpstream' => $this->integer(),
            'SelectedShippingShop' => $this->integer(),
            'ViewGP' => $this->string(),
            'DeliveryType' => $this->string(),
            'ImgPlannedStatus' => $this->string(),
            'RoutingId' => $this->string(),
            'Name' => $this->string(),
            'ProductId' => $this->string(),
            'ProductName' => $this->string(),
            'LatestDesiredDeliveryDate' => $this->string(),
            'ProductSpecificationId' => $this->string(),
            'ResourceGroupIds' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%raw_cols}}');
    }
}
